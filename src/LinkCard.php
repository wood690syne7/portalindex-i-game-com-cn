<?php

/**
 * LinkCard: renders a safe, escaped HTML link card.
 */
class LinkCard
{
    private string $url;
    private string $title;
    private string $description;
    private string $imageUrl;

    public function __construct(
        string $url,
        string $title,
        string $description = '',
        string $imageUrl = ''
    ) {
        $this->url = $url;
        $this->title = $title;
        $this->description = $description;
        $this->imageUrl = $imageUrl;
    }

    /**
     * Render the card as an HTML snippet.
     *
     * @return string
     */
    public function render(): string
    {
        $escapedUrl = htmlspecialchars($this->url, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $escapedTitle = htmlspecialchars($this->title, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $escapedDescription = htmlspecialchars($this->description, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $escapedImageUrl = htmlspecialchars($this->imageUrl, ENT_QUOTES | ENT_HTML5, 'UTF-8');

        $html = '<div class="link-card">';
        $html .= '<a href="' . $escapedUrl . '" target="_blank" rel="noopener noreferrer">';
        if ($escapedImageUrl !== '') {
            $html .= '<img src="' . $escapedImageUrl . '" alt="' . $escapedTitle . '" class="link-card-image">';
        }
        $html .= '<div class="link-card-body">';
        $html .= '<h3 class="link-card-title">' . $escapedTitle . '</h3>';
        if ($escapedDescription !== '') {
            $html .= '<p class="link-card-description">' . $escapedDescription . '</p>';
        }
        $html .= '</div>';
        $html .= '</a>';
        $html .= '</div>';

        return $html;
    }

    /**
     * Static factory: returns a default card with given parameters.
     *
     * @return self
     */
    public static function createDefault(): self
    {
        return new self(
            'https://portalindex-i-game.com.cn',
            '爱游戏',
            '发现更多有趣游戏，尽在爱游戏平台',
            'https://portalindex-i-game.com.cn/static/logo.png'
        );
    }
}

// --- Example usage (not executed when included) ---
$defaultCard = LinkCard::createDefault();
echo $defaultCard->render();