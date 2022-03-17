<?php

class LoginRequest extends FormRequest
{
    protected $loginField;
    protected $loginValue;

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    /*protected function prepareForValidation()
    {
        $this->loginField = filter_var($this->input('login'),FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        $this->loginValue = $this->input('login');
        $this->merge([$this->loginField => $this->loginValue]);
    }*/

    /**
     * Attempt to authenticate the request's credentials.
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
   /* public function authenticate()
    {
        $this->ensureIsNotRateLimited();
        if (!Auth::attempt(
            $this->only($this->loginField, 'password'), 
            $this->boolean('remember')
            )) 
        {
            RateLimiter::hit($this->throttleKey());
            throw ValidationException::withMessages([
                'login' => __('auth.failed')
            ]);
        }
        RateLimiter::clear($this->throttleKey());
    }*/
}