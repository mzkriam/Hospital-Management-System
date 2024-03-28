<?php

namespace App\Http\Requests\Auth;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class LoginRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        return [
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ];
    }
    //     هذه الدالة تقوم بالتحقق من صحة المستخدم
    // - `public function authenticate()`: هذه هي الدالة العامة للتحقق من صحة المستخدم.
    // - `$this->ensureIsNotRateLimited();`: يتأكد هذا السطر من أن المستخدم لم يتجاوز الحد المسموح به لمحاولات تسجيل الدخول.
    // - `if (!Auth::attempt($this->only('email', 'password'), $this->boolean('remember')))` : يقوم هذا الشرط بمحاولة تسجيل دخول المستخدم باستخدام البريد الإلكتروني وكلمة المرور التي أدخلها. إذا كانت معلومات تسجيل الدخول غير صحيحة، يتم تنفيذ الكود داخل الشرط.
    // - `RateLimiter::hit($this->throttleKey());`: يزيد هذا السطر من عدد محاولات تسجيل الدخول الفاشلة للمستخدم.
    // - `throw ValidationException::withMessages(['email' => trans('auth.failed')]);`: يقوم هذا السطر بإرجاع رسالة خطأ تفيد بأن معلومات تسجيل الدخول غير صحيحة.
    // - `RateLimiter::clear($this->throttleKey());`: يقوم هذا السطر بإعادة تعيين عداد محاولات تسجيل الدخول الفاشلة للمستخدم بعد تسجيل دخول ناجح.
    public function authenticate()
    {
        $this->ensureIsNotRateLimited();
        if (!Auth::attempt($this->only('email', 'password'), $this->boolean('remember'))) {
            RateLimiter::hit($this->throttleKey());
            throw ValidationException::withMessages([
                'email' => trans('auth.failed'),
            ]);
        }
        RateLimiter::clear($this->throttleKey());
    }

    public function ensureIsNotRateLimited()
    {
        if (!RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
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
    //    هذه الدالة تقوم بإنشاء مفتاح للتحكم بعدد محاولات تسجيل الدخول

    // - `public function throttleKey()`: هذه هي الدالة العامة لإنشاء مفتاح التحكم بعدد محاولات تسجيل الدخول.
    // - `return Str::lower($this->input('email')) . '|' . $this->ip();`: يقوم هذا السطر بإرجاع مفتاح يتكون من البريد الإلكتروني للمستخدم (بأحرف صغيرة) وعنوان IP الخاص به، مفصولين برمز '|'. يتم استخدام هذا المفتاح لتعقب عدد محاولات تسجيل الدخول الفاشلة للمستخدم.

    public function throttleKey()
    {
        return Str::lower($this->input('email')) . '|' . $this->ip();
    }
}
