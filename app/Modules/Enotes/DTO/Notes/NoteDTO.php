<?php

namespace App\Modules\Enotes\DTO\Notes;

use App\DTO\BaseDTO;
use App\Helpers\TiptapHelper;
use App\Models\Dictionaries\DictionaryColor;
use App\Modules\Enotes\Models\Section;
use App\Validation\Rules\TiptapLengthRule;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class NoteDTO extends BaseDTO
{
    const LIMIT_HEADING_SIZE = 255;

    const LIMIT_PREVIEW_SIZE = 1200;

    const LIMIT_CONTENT_SIZE = 20000;

    const LIMIT_PREVIEW_PARAGRAPHS = 20;

    const LIMIT_PREVIEW_WORDS = 40;

    protected string|null $title = null;

    protected array|null $heading = [];

    protected array|null $content = [];

    protected string|null $colorUlid = null;

    protected string|null $sectionUlid = null;

    /**
     * @throws ValidationException
     */
    public function __construct(array $data)
    {
        parent::__construct($data);

        $this->prepare($data);

        $this->title = $data['title'] ?? null;
        $this->heading = $data['heading'] ?? null;
        $this->content = $data['content'] ?? null;
        $this->colorUlid = $data['color_id'] ?? null;
        $this->sectionUlid = $data['section_id'] ?? null;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function getHeading(): ?array
    {
        return $this->heading;
    }

    public function getHeadingJson(): ?string
    {
        return $this->rememberVariable('heading_json', function () {
            if (!$this->getHeading()) return null;

            return TiptapHelper::getJsonByArray($this->getHeading());
        });
    }

    public function getContent(): ?array
    {
        return $this->content;
    }

    public function getContentJson(): ?string
    {
        return $this->rememberVariable('content_json', function () {
            if (!$this->getContent()) return null;

            return $this->getContentJsonByArray($this->getContent());
        });
    }

    public function getPreviewJson(): ?string
    {
        return $this->rememberVariable('preview_json', function () {
            if (!$this->getContent()) return null;

            return $this->getPreviewJsonByArray($this->getContent());
        });
    }

    public function getColorUlid(): ?string
    {
        return $this->colorUlid;
    }

    public function getColorId(): ?int
    {
        return $this->rememberVariable('color_id', function () {
            if (!$this->getColorUlid()) return null;

            return DictionaryColor::getIdByUlid($this->getColorUlid());
        });
    }

    public function getSectionUlid(): ?string
    {
        return $this->sectionUlid;
    }

    public function getSectionId(): ?int
    {
        return $this->rememberVariable('section_id', function () {
            if (!$this->getSectionUlid()) return null;

            return Section::getIdByUlid($this->getSectionUlid());
        });
    }

    protected function getLimitPreviewSize(): int
    {
        return self::LIMIT_PREVIEW_SIZE;
    }

    protected function getLimitContentSize(): int
    {
        return self::LIMIT_CONTENT_SIZE;
    }

    protected function getContentJsonByArray(array $content): ?string
    {
        $node = json_decode(json_encode($content));

        $output = [];

        TiptapHelper::walkThroughTextNodes($node, function (&$node) use (&$size, &$countNodes) {
            if ($node->type === "text" && ($node->text == null || $node->text == "")) {
                $node->text = " ";
            }

            return true;
        }, $output);

        if ($output) {
            return (new \Tiptap\Editor)
                ->setContent($output)
                ->getJSON();
        }

        return null;
    }

    protected function getPreviewJsonByArray(array $content): ?string
    {
        $node = json_decode(json_encode($content));

        $output = [];

        $size = 0;

        $countParagraphs = 0;

        TiptapHelper::walkThroughTextNodes($node, function (&$node) use (&$size, &$isBreak, &$countParagraphs) {
            if($isBreak) {
                return false;
            }

            if ($node->type === "text" && isset($node->text)) {
                $size = $size + strlen($node->text);

                if ($size > $this->getLimitPreviewSize()) {
                    $node->text = Str::words($node->text, self::LIMIT_PREVIEW_WORDS, ' ... ');

                    $isBreak = true;
                }
            }

            if ($node->type === "paragraph"  && $countParagraphs > self::LIMIT_PREVIEW_PARAGRAPHS) {
                return false;
            }

            $countParagraphs++;

            return true;
        }, $output);

        if ($output) {
            return (new \Tiptap\Editor)
                ->setContent($output)
                ->getJSON();
        }

        return null;
    }

    protected function rules(): array
    {
        return [
            'title' => ['string', 'nullable', 'max:255'],
            'heading' => ['array', 'nullable', 'min:1', new TiptapLengthRule(self::LIMIT_HEADING_SIZE)],
            'content' => ['nullable', 'required_without:heading', 'array', 'min:1', new TiptapLengthRule($this->getLimitContentSize())],
            'color_id' => ['ulid', 'nullable', Rule::exists(DictionaryColor::class, 'ulid')],
            'section_id' => ['ulid', 'nullable', Rule::exists(Section::class, 'ulid')],
        ];
    }
}
