<?php

namespace App\Http\Requests\Auth;

use App\Models\Colaborador;
use App\Models\DocColaborador;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'cpf' => ['required', 'string', 'numeric'],
            'password' => ['required', 'string'],
        ];
    }

    /**
     * Attempt to authenticate the request's credentials.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function authenticate()
    {

        // $this->email = ;
        // dd($email);
        // dd($this->cpf);
        // $this->only('email', 'password')
        // dd(Colaborador::find(DocColaborador::where('numero',$this->cpf)->get()->first()->colaborador_id)->id);
        $dados = DocColaborador::where('numero',$this->cpf)->get();
        // dd($dados);
        if($dados->count()==0){
            return redirect('/login')->with('status', 'Dados de login incorretos');
            // return redirect('/login')->withInput();
        }
        $this->ensureIsNotRateLimited();
        $colaborador = Colaborador::where('id',$dados->first()->colaborador_id)->withoutGlobalScopes()->get()->first();
        if(!is_null($colaborador->tenant_id)){
            session(['tenant_id'=>$colaborador->tenant_id]);
        }else{
            session(['tenant_id'=>null]);
        }
        // dd($colaborador->usuario);
        if (! Auth::attempt(['email'=>$colaborador->usuario->first()->email,'password'=>$_REQUEST['password']], $this->boolean('remember'))) {
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'email' => trans('auth.failed'),
            ]);
        }

        RateLimiter::clear($this->throttleKey());
    }

    /**
     * Ensure the login request is not rate limited.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function ensureIsNotRateLimited(): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout($this));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'email' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    /**
     * Get the rate limiting throttle key for the request.
     */
    public function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->string('email')).'|'.$this->ip());
    }
}
