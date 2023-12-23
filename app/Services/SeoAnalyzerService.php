<?php

namespace App\Services;

class SeoAnalyzerService
{
    const MAX_SCORE = 100;
    const MINIMUM_KEYWORD_DENSITY = 1;
    const MAXIMUM_KEYWORD_DENSITY = 1.5;

    const MAXIMUM_SUB_KEYWORD_DENSITY = 0.9;
    const MINIMUM_SUB_KEYWORD_DENSITY = 0.12;
    const EXTREME_LOW_SUB_KEYWORD_DENSITY = 0.09;

    const MAXIMUM_META_DESCRIPTION_LENGTH = 160;
    const MAXIMUM_META_DESCRIPTION_DENSITY = 5;
    const MINIMUM_META_DESCRIPTION_DENSITY = 2;

    const MAXIMUM_TITLE_LENGTH = 10;
    const MINIMUM_TITLE_LENGTH = 7;

    const MAXIMUM_SUB_KEYWORD_IN_META_DESCRIPTION_DENSITY = 5;
    const MINIMUM_SUB_KEYWORD_IN_META_DESCRIPTION_DENSITY = 2;

    public $data;
    public $keywordDensity;
    public $cleanContent;
    public $messages = [
        'dangers' => [],
        'warnings' => [],
        'goods' => [],
    ];
    private $results;

    public function __construct($data)
    {
        $this->data = $data;
        $this->cleanContentFromHtml();
        $this->keywordDensity = $this->countDensityOfKeywordInContent()['density'];
    }

    private function countDensityOfKeywordInContent($keyword = null): array
    {
        $mainKeyword = $keyword == null ? $this->data->main_keyword : $keyword;
        return [
            "keyword" => trim($mainKeyword),
            "density" => $this->calculateDensity($mainKeyword, $this->cleanContent)
        ];
    }

    private function countDensityOfSubKeywordsInContent(): array
    {
        $densities = [];
        if ($this->data->keyword === '' || $this->data->keyword === null) {
            return $densities;
        }

        $keywords = $this->data->keyword;
        foreach (explode(',', $keywords) as $keyword) {
            $densities[] = $this->countDensityOfKeywordInContent(trim($keyword));
        }

        return $densities;
    }

    private function countDensityOfKeywordInTitle($keyword = null): array
    {
        $mainKeyword = $keyword == null ? $this->data->main_keyword : $keyword;
        return [
            "keyword" => trim($mainKeyword),
            "density" => $this->calculateDensity($mainKeyword, $this->data->title),
            "position" => array_search(trim($mainKeyword), explode(' ', $this->data->title)) - 1
        ];
    }

    private function countDensityOfSubKeywordsInTitle(): array
    {
        $densities = [];
        if ($this->data->keyword === '' || $this->data->keyword === null) {
            return $densities;
        }

        $keywords = $this->data->keyword;
        foreach (explode(',', $keywords) as $keyword) {
            $densities[] = $this->countDensityOfKeywordInTitle(trim($keyword));
        }

        return $densities;
    }

    private function countDensityOfKeywordInMetaDescription($keyword = null): array
    {
        $mainKeyword = $keyword == null ? $this->data->main_keyword : $keyword;
        return [
            "keyword" => trim($mainKeyword),
            "density" => $this->calculateDensity($mainKeyword, $this->data->description),
            "position" => array_search(trim($mainKeyword), explode(' ', $this->data->description)) - 1
        ];
    }

    private function countDensityOfSubKeywordsInMetaDescription($keyword = null): array
    {
        $densities = [];
        if ($this->data->keyword === '' || $this->data->keyword === null) {
            return $densities;
        }

        $keywords = $this->data->keyword;
        foreach (explode(',', $keywords) as $keyword) {
            $densities[] = $this->countDensityOfKeywordInMetaDescription(trim($keyword));
        }

        return $densities;
    }

    private function countDensityOfKeywordInAltImage($keyword = null): array
    {
        $mainKeyword = $keyword == null ? $this->data->main_keyword : $keyword;
        return [
            "keyword" => trim($mainKeyword),
            "density" => $this->calculateDensity($mainKeyword, $this->data->alt_image),
            "position" => array_search(trim($mainKeyword), explode(' ', $this->data->alt_image)) - 1
        ];
    }

    private function countDensityOfSubKeywordsInAltImage($keyword = null): array
    {
        $densities = [];
        if ($this->data->keyword === '' || $this->data->keyword === null) {
            return $densities;
        }

        $keywords = $this->data->keyword;
        foreach (explode(',', $keywords) as $keyword) {
            $densities[] = $this->countDensityOfKeywordInAltImage(trim($keyword));
        }

        return $densities;
    }


    private function getSeoScore()
    {
        $score = (count($this->messages['goods']) / (count($this->messages['warnings']) + count($this->messages['dangers']))) * 100;
        return min([$score, $this::MAX_SCORE]);
    }

    private function getSeoKeywordScore()
    {
        $keywordInTitle = $this->countDensityOfKeywordInTitle();
        $subKeywordInTitle = $this->countDensityOfSubKeywordsInTitle();
        $subKeywordInContent = $this->countDensityOfSubKeywordsInContent();
        $keywordInAltImage = $this->countDensityOfKeywordInAltImage();
        $keywordInAltImageScore = $keywordInAltImage['density'] * 10;
        $keywordInTitleScore = $keywordInTitle['density'] * 10;
        $subKeywordInTitleScore = count($subKeywordInTitle) * 10;
        $subKeywordDensityScore = array_reduce($subKeywordInContent, function ($total, $subKeywordDensity) {
            return $total + ($subKeywordDensity['density'] * 10);
        }, 0);
        $keywordDensityScore = $this->keywordDensity * 10;
        $totalScore = $keywordInTitleScore + $subKeywordInTitleScore + $subKeywordDensityScore + $keywordDensityScore + $keywordInAltImageScore;
        return min([$totalScore, $this::MAX_SCORE]);
    }

    private function getTitleWordCount()
    {
        return str_word_count($this->data->title);
    }

    private function assignMessageForKeyword(): void
    {
        if ($this->data->main_keyword) {
            $keyword = $this->data->main_keyword;
            $this->messages['goods'][] = "Good, your content has a keyword $keyword";

            if ($this->keywordDensity > 5) {
                $this->messages['warnings'][] = "Serious keyword overstuffing";
            }

            if ($this->keywordDensity < $this::MINIMUM_KEYWORD_DENSITY) {
                $this->messages['warnings'][] = "Keyword density is too low. It is $this->keywordDensity%, try to increasing it";
            } else if ($this->keywordDensity > $this::MAXIMUM_KEYWORD_DENSITY) {
                $this->messages['warnings'][] = "Keyword density is too high. It is $this->keywordDensity%. try to decreasing it";
            } else {
                $this->messages['goods'][] = "Keyword density is $this->keywordDensity";
            }
        } else {
            $this->messages['dangers'][] = "Missing main keyword, please add one";
        }
    }

    private function assignMessageForSubKeywords(): void
    {
        if (count(explode(',', $this->data->keyword)) > 0 && ($this->data->keyword !== '' && $this->data->keyword !== null)) {
            $keyword = $this->data->keyword;
            $this->messages['goods'][] = "Good, your content has sub keywords $keyword";

            foreach ($this->countDensityOfSubKeywordsInContent() as $subKeyword) {
                $density = $subKeyword['density'];
                $keyword = $subKeyword['keyword'];
                if ($density > $this::MAXIMUM_SUB_KEYWORD_DENSITY) {
                    $this->messages['warnings'][] = "The density of sub keyword $keyword is too high in the content, $density%";
                } else if ($density < $this::MINIMUM_SUB_KEYWORD_DENSITY) {
                    $status = $density < $this::EXTREME_LOW_SUB_KEYWORD_DENSITY ? "too low" : "low";
                    $this->messages['warnings'][] = "The density of sub keyword $keyword is $status in the content, $density%";
                } else {
                    $this->messages['goods'][] = "The density of sub keyword $keyword is good in the content, $density%";
                }
            }
        } else {
            $this->messages['dangers'][] = "Missing sub keywords, please add some";
        }
    }

    private function assignMessageForTitle(): void
    {
        if ($this->data->title) {
            if (str_word_count($this->data->title) > $this::MAXIMUM_TITLE_LENGTH) {
                $this->messages['warnings'][] = "Title is too long";
            } else if (str_word_count($this->data->title) < $this::MINIMUM_TITLE_LENGTH) {
                $this->messages['warnings'][] = "Title is too short";
            } else {
                $this->messages['goods'][] = "Title tag is good";
            }

            $keywordDensityInTitle = $this->countDensityOfKeywordInTitle()['density'];
            if ($keywordDensityInTitle) {
                $this->messages['goods'][] = "Keyword density in title $keywordDensityInTitle%";
            } else {
                $this->messages['warnings'][] = "No main keyword in title";
            }

            $subKeywordInTitle = $this->countDensityOfSubKeywordsinTitle();
            if (count($subKeywordInTitle)) {
                $this->messages['goods'][] = "You have " . count($subKeywordInTitle) . " sub keywords in title";
            } else {
                $this->messages['errors'][] = "No sub keywords in title";
            }
        } else {
            $this->messages['dangers'][] = "Missing title, please add one";
        }
    }

    private function assignMessagesForMetaDescription(): void
    {
        if (!empty($this->data->description)) {
            $keywordInMetaDescription = $this->countDensityOfKeywordInMetaDescription();

            // Warning for meta description length
            $metaDescriptionLength = mb_strlen($this->data->description);
            if ($metaDescriptionLength > $this::MAXIMUM_META_DESCRIPTION_LENGTH) {
                $this->messages['warnings'][] = "Meta description is too long. It is $metaDescriptionLength characters long, try reducing it.";
            } elseif ($metaDescriptionLength < 100) {
                $this->messages['warnings'][] = "Meta description is too short. It is $metaDescriptionLength characters long, try increasing it.";
            } else {
                $this->messages['goods'][] = "Meta description is $metaDescriptionLength characters long.";

                // Warning for meta description keyword density
                if ($keywordInMetaDescription['density'] > $this::MAXIMUM_META_DESCRIPTION_DENSITY) {
                    $this->messages['warnings'][] = "Keyword density of meta description is too high. It is " . $keywordInMetaDescription['density'] . "%, try decreasing it.";
                } elseif ($keywordInMetaDescription['density'] < $this::MINIMUM_META_DESCRIPTION_DENSITY) {
                    $this->messages['warnings'][] = "Keyword density of meta description is too low. It is " . $keywordInMetaDescription['density'] . "%, try increasing it.";
                } else {
                    $this->messages['goods'][] = "Keyword density of meta description is " . $keywordInMetaDescription['density'] . "%, which is good.";
                }
            }

            // Warning for meta description not starting with keyword
            if ($keywordInMetaDescription['position'] > 1) {
                $this->messages['dangers'][] = "Meta description does not start with keyword. It starts with " . mb_substr($this->data->description, 0, 20) . ", try starting with keyword. Not starting with keyword is not a big issue, but it is recommended to start with the keyword.";
            } else {
                $this->messages['goods'][] = "Meta description starts with keyword, i.e. " . mb_substr($this->data->description, 0, 20) . ".";
            }

            // Warning for meta description not ending with keyword
            $subKeywordsInMetaDescription = $this->countDensityOfSubKeywordsInMetaDescription();
            foreach ($subKeywordsInMetaDescription as $subKeyword) {
                if ($subKeyword['density'] > $this::MAXIMUM_SUB_KEYWORD_IN_META_DESCRIPTION_DENSITY) {
                    $this->messages['warnings'][] = "The density of sub keyword " . $subKeyword['keyword'] . " in meta description is too high, i.e. " . $subKeyword['density'] . "%.";
                } elseif ($subKeyword['density'] < $this::MINIMUM_SUB_KEYWORD_IN_META_DESCRIPTION_DENSITY) {
                    $densityBeingLowString = $subKeyword['density'] < 0.2 ? 'too low' : 'low';
                    $this->messages['dangers'][] = "The density of sub keyword " . $subKeyword['keyword'] . " in meta description is $densityBeingLowString, i.e. " . $subKeyword['density'] . "%.";
                } else {
                    $this->messages['goodPoints'][] = "The density of sub keyword " . $subKeyword['keyword'] . " in meta description is " . $subKeyword['density'] . "%.";
                }
            }
        } else {
            $this->messages['dangers'][] = 'Missing meta description.';
        }
    }

    private function assignMessageForKeywordInAltImage(): void
    {
        if ($this->data->alt_image) {
            $alt_image = $this->data->alt_image;
            $this->messages['goods'][] = "Good, your content has an alt image $alt_image";

            $keywordDensity = $this->countDensityOfKeywordInAltImage()['density'];
            if ($keywordDensity > 5) {
                $this->messages['warnings'][] = "Serious keyword in alt image overstuffing";
            }

            if ($keywordDensity < $this::MINIMUM_KEYWORD_DENSITY) {
                $this->messages['warnings'][] = "Keyword density in alt image is too low. It is $keywordDensity%, try to increasing it";
            } else if ($keywordDensity > $this::MAXIMUM_KEYWORD_DENSITY) {
                $this->messages['warnings'][] = "Keyword density in alt image is too high. It is $keywordDensity%. try to decreasing it";
            } else {
                $this->messages['goods'][] = "Keyword density in alt image is $keywordDensity";
            }
        } else {
            $this->messages['dangers'][] = "Missing main keyword in alt image, please add one";
        }
    }

    private function cleanContentFromHtml(): void
    {
        $this->cleanContent = strip_tags($this->data->content);
    }

    private function calculateDensity($keyword, $text): float|int
    {
        if ($keyword === '' || $keyword === null || $text === '' || $text === null) {
            return 0;
        }
        return ($this->countOccurrencesInString(trim($keyword), $text) / str_word_count($text)) * 100;
    }

    private function countOccurrencesInString($keyword, $text): int
    {
        return count(explode(trim($keyword), $text)) - 1;
    }

    public function analyze()
    {
        $this->assignMessageForKeyword();
        $this->assignMessageForSubKeywords();
        $this->assignMessageForTitle();
        $this->assignMessageForSubKeywords();
        $this->assignMessagesForMetaDescription();
        $this->assignMessageForKeywordInAltImage();
        return $this->results = (object) [
            'seo_score' => $this->getSeoScore(),
            'seo_keyword' => $this->getSeoKeywordScore(),
            'messages' => $this->messages
        ];
    }
}
