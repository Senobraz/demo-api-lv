<?php

namespace App\DTO\Accounts;

use App\DTO\BaseDTO;
use App\Models\Localizations\Language;
use App\Models\User\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;

class CreateAccountDTO extends BaseDTO
{
    protected string|null $name = null;

    protected string|null $email = null;

    protected string|null $password = null;

    protected string|null $ip = null;

    protected string|null $host = null;

    protected string|null $domain = null;

    protected string|null $language = null;

    protected string|null $timezone = null;

    protected string|null $dateFormat = null;

    protected string|null $timeFormat = null;

    protected int|string|null $weekStart = null;

    protected int|string|null $appearanceMode = null;

    protected string|null $appearanceTheme = null;

    protected string|null $appearanceColor = null;

    /**
     * @throws ValidationException
     */
    public function __construct(array $data)
    {
        parent::__construct($data);

        $this->prepare($data);

        $this->name = $data['name'];
        $this->email = $data['email'];
        $this->password = $data['password'];
        $this->ip = $data['ip'];
        $this->host = $data['host'];
        $this->domain = $data['domain'];
        $this->language = $data['language'];
        $this->timezone = $data['timezone'] ?? null;
        $this->dateFormat = $data['date_format'] ?? null;
        $this->timeFormat = $data['time_format'] ?? null;
        $this->weekStart = $data['week_start'] ?? null;
        $this->appearanceMode = $data['appearance_mode'] ?? null;
        $this->appearanceTheme = $data['appearance_theme'] ?? null;
        $this->appearanceColor = $data['appearance_color'] ?? null;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getPasswordHash(): string
    {
        return Hash::make($this->getPassword());
    }

    public function getIp(): string
    {
        return $this->ip;
    }

    public function getHost(): string
    {
        return $this->host;
    }

    public function getDomain(): string
    {
        return $this->domain;
    }

    public function getLanguageCode(): string
    {
        return $this->language;
    }

    public function getLanguageId(): string
    {
        return Language::ofCode($this->getLanguageCode())->first()->getId();
    }

    public function getTimezone(): string
    {
        return $this->timezone ?? config('app.reg_timezone');
    }

    public function getDateFormat(): string
    {
        return $this->dateFormat ?? config('app.reg_date_format');
    }

    public function getTimeFormat(): string
    {
        return $this->timeFormat ?? config('app.reg_time_format');
    }

    public function getWeekStart(): int
    {
        return (int)($this->weekStart ?? config('app.reg_week_start'));
    }

    public function getAppearanceMode(): string
    {
        return $this->appearanceMode ?? config('app.reg_appearance_mode');
    }

    public function getAppearanceTheme(): string
    {
        return $this->appearanceTheme ?? config('app.reg_appearance_theme');
    }

    public function getAppearanceColor(): string
    {
        return $this->appearanceColor ?? config('app.reg_appearance_color');
    }

    protected function prepare(&$data): void
    {
        parent::prepare($data);

        if (!isset($data['name']) || !$data['name']) {
            $data['name'] = ucfirst(substr($data['email'], 0, strrpos($data['email'], '@')));
        }
    }

    protected function rules(): array
    {
        return [
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'ip' => ['required', 'string', 'max:45', 'ip'],
            'host' => ['required', 'string', 'max:255'],
            'domain' => ['required', 'string', 'max:255'],
            'language' => ['nullable', 'string', Rule::in(Language::getLanguageCodes())],
        ];
    }

    static public function fromRequest(Request $request): static
    {
        $data = array_merge($request->all(), [
            'ip' => $request->ip(),
            'host' => $request->getHost(),
            'domain' => strtolower(preg_replace('#(^http(s)?://)|(:\d+$)#', '', trim($request->headers->get('origin')))),
        ]);

        return new static($data);
    }
}
