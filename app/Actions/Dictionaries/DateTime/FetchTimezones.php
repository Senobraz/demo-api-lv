<?php

namespace App\Actions\Dictionaries\DateTime;

use App\Actions\Dictionaries\DictionaryAction;
use App\Helpers\TimezoneHelper;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class FetchTimezones extends DictionaryAction
{
    const FORMAT_LIST = 'list';

    const FORMAT_GROUPED = 'grouped';

    protected string $format;

    protected mixed $dictionary = [];

    /**
     * @throws ValidationException
     */
    public function execute(array $data): void
    {
        $this->validate($data);

        $this->prepare($data);

        $this->format = $data['package'];

        $this->dictionary = $this->format === self::FORMAT_GROUPED ? TimezoneHelper::getTimezoneListByGroups() : TimezoneHelper::getTimezoneList();
    }

    public function getPackages(): ?array
    {
        return [
            self::FORMAT_LIST,
            self::FORMAT_GROUPED,
        ];
    }

    protected function rules(): array
    {
        return [
            'package' => ['required', 'string', Rule::in($this->getPackages())],
        ];
    }

    protected function resource(): ResourceCollection|array|null
    {
        return [
            'data' => $this->dictionary,
        ];
    }
}
