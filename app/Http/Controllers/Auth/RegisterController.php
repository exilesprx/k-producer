<?php

namespace App\Http\Controllers\Auth;

use App\Events\Domain\UserCreated;
use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use App\Services\EventBusService;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    private $service;

    private $repository;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @param EventBusService $service
     * @param UserRepository $repository
     */
    public function __construct(EventBusService $service, UserRepository $repository)
    {
        $this->middleware('guest');

        $this->service = $service;

        $this->repository = $repository;
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     * @return \App\Entities\User
     */
    protected function create(array $data)
    {
        $user = $this->repository->createNewUser(
            $data['name'],
            $data['email'],
            $data['password']
        );

        $event = UserCreated::from($user);

        $this->service->dispatchEvent($event);

        return $user;
    }
}
