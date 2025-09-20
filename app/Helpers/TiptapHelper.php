<?php

namespace App\Helpers;

use Throwable;
use Tiptap\Editor;

class TiptapHelper
{
    static public function editor(): Editor
    {
        return new \Tiptap\Editor([
            'extensions' => [
                new \Tiptap\Extensions\StarterKit,
            ],
        ]);
    }

    static public function walkThroughTextNodes($node, $closure, &$out = null): void
    {
        $isBreak = !$closure($node);

        if($node->type === 'horizontalRule') {
            if (!is_null($out)) {
                $out[] = $node;
            }

            return;
        }

        if ($node->type === 'text') {
            if ($isBreak === true) {
                return;
            }

            if (!is_null($out)) {
                $out[] = $node;
            }

            return;
        }

        if (!isset($node->content)) {
            return;
        }

        $content = is_array($node->content) ? $node->content : [];

        $nodeContent = [];

        foreach ($content as $index => $child) {
            self::walkThroughTextNodes($child, $closure, $nodeContent);
        }

        if ($nodeContent) {
            $nodeOut = [
                ...json_decode(json_encode($node), true),
                ...['content' => $nodeContent],
            ];

            if ($node->type === 'doc' && !is_null($out)) {
                $out = $nodeOut;
            } else {
                $out[] = $nodeOut;
            }
        }
    }

    static public function getLength(array $content): int
    {
        $size = 0;

        $node = json_decode(json_encode($content));

        TiptapHelper::walkThroughTextNodes($node, function ($node) use (&$size) {
            if ($node->type === "text" && isset($node->text) && $node->text) {
                $size = $size + strlen($node->text);
            }

            return true;
        });

        return $size;
    }

    static public function checkLimitLength(array $content, $length = 0): int
    {
        $size = 0;

        $isExceed = false;

        $node = json_decode(self::getJsonByArray($content));

        TiptapHelper::walkThroughTextNodes($node, function ($node) use (&$size, &$isExceed, $length) {
            if ($node->type === "text" && isset($node->text)) {
                $size = $size + strlen($node->text);

                if ($size > $length) {
                    $isExceed = true;

                    return false;
                }
            }

            return true;
        });

        return !$isExceed;
    }

    static public function getJsonByArray(array $value): ?string
    {
        return self::editor()->setContent($value)->getJSON();
    }

    static public function getJsonByHtml(string $value): ?string
    {
        return self::editor()->setContent($value)->getJSON();
    }

    static public function getTextByArray(array $value): ?string
    {
        return self::editor()->setContent($value)->getText();
    }

    static public function getHtmlByArray(array $value): ?string
    {
        return self::editor()->setContent($value)->getHTML();
    }

    static public function validateContentByArray(array $value): bool
    {
        try {
            if(!isset($value['type']) || !isset($value['content']) || $value['type'] !== 'doc') {
                return false;
            }

            self::editor()->setContent($value);

            return true;
        } catch (Throwable $e) {
            return false;
        }
    }

    /** draft */
    static public function escapeContent($data) {
        if (is_array($data)) {
            foreach ($data as $key => $value) {
                $data[$key] = self::escapeContent($value);
            }
        } elseif (is_string($data)) {
            $data = htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
        }

        return $data;
    }
}
