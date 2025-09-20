<?php

namespace App\DTO\Localizations;

use App\DTO\BaseDTO;
use App\Models\Localizations\Localization;
use App\Validation\Rules\DelimitedRule;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class FetchLocalizationsDTO extends BaseDTO
{
    protected string|null $lang = null;

    protected array|null $packages = [];

    /**
     * @throws ValidationException
     */
    public function __construct(array $data)
    {
        parent::__construct($data);

        $this->prepare($data);

        $this->lang = $data['lang'];
        $this->packages = $data['packages'];
    }

    function getLang(): string
    {
        return $this->lang;
    }

    function getPackages(): array
    {
        return $this->packages;
    }

    protected function prepare(&$data): void
    {
        parent::prepare($data);

        $packages = explode(',', $data['package']);

        $data['packages'] = [];
        foreach ($packages as $packageCode) {
            if (in_array($packageCode, Localization::getPackageCodes())) {
                $data['packages'][] = $packageCode;
            }
        }
    }

    protected function rules(): array
    {
        return [
            'lang' => ['required', 'string', Rule::in(Localization::getLanguageCodes())],
            'package' => ['required', 'string', new DelimitedRule(Localization::getPackageCodes())],
        ];
    }
}
