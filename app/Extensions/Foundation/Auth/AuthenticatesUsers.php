<?php

namespace App\Extensions\Foundation\Auth;

use Illuminate\Foundation\Auth\AuthenticatesUsers as DefaultAuthenticatesUsers;
use Illuminate\Http\Request;

trait AuthenticatesUsers
{
    use DefaultAuthenticatesUsers;

    /**
     * Get the view the form login to be used by the controller.
     *
     * @return string
     */
    public function loginForm()
    {
        return 'auth.login';
    }

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        return view($this->loginForm());
    }


    /**
     * Get the login password to be used by the controller.
     *
     * @return string
     */
    public function password()
    {
        return 'password';
    }

    /**
     * Validate the user login request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function validateLogin(Request $request)
    {
        $request->validate([
            $this->username() => 'required|string',
            $this->password() => 'required|string',
        ]);
    }

    /**
     * Get the needed authorization credentials from the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function credentials(Request $request)
    {
        return $request->only($this->username(), $this->password());
    }
}