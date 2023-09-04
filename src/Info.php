<?php

namespace CrusherRL\NovaCards;

use Laravel\Nova\Card;

class Info extends Card
{
    /**
     * The width of the card (1/3, 1/2, or full).
     *
     * @var string
     */
    public $width = 'full';

    /**
     * The height strategy of the card.
     *
     * @var string
     */
    public $height = '30px';

    /**
     * Custom color for the info card.
     *
     * Understands all css colors. There are also there are predefined color:
     * 'blue-200'    => 'rgb(191 219 254)',
     * 'green-200':  => 'rgb(187 247 208)',
     * 'yellow-200': => 'rgb(254 240 138)',
     * 'red-200':    => 'rgb(254 202 202)',
     * 'blue-600':   => 'rgb(37 99 235)',
     * 'green-600':  => 'rgb(22 163 74)',
     * 'yellow-600': => 'rgb(202 138 4)',
     * 'red-600':    => 'rgb(220 38 38)',
     *
     * @var array|null[]
     */
    public array $customColors = [
      'border' => null,
      'background' => null,
      'text' => null,
      'icon' => null
    ];

    /**
     * @var bool
     */
    protected bool $withHeading = false;

    /**
     * Get the component name for the element.
     *
     * @return string
     */
    public function component(): string
    {
        return 'info-card';
    }

    /**
     * The message to be displayed.
     *
     * @param string $message
     * @param string $theme
     * @return $this
     */
    public function message(string $message, string $theme = 'info'): static
    {
        $this->colors();
        return $this->withMeta(compact('message', 'theme'));
    }

    /**
     * The message to be displayed.
     *
     * @param string $message
     * @param string $theme
     * @return $this
     */
    private function colors(): static
    {
        return $this->withMeta(['colors' => $this->customColors]);
    }

    /**
     * Displays message with an "info" theme.
     *
     * @param string $message
     * @return $this
     */
    public function info(string $message): static
    {
        return $this->message($message);
    }

    /**
     * Displays message with a "success" theme.
     *
     * @param string $message
     * @return $this
     */
    public function success(string $message): static
    {
        return $this->message($message, 'success');
    }

    /**
     * Displays message with a "warning" theme.
     *
     * @param string $message
     * @return $this
     */
    public function warning(string $message): static
    {
        return $this->message($message, 'warning');
    }

    /**
     * Displays message with a "danger" theme.
     *
     * @param string $message
     * @return $this
     */
    public function danger(string $message): static
    {
        return $this->message($message, 'danger');
    }

    /**
     * Displays a heading with the given message.
     *
     * @param string $heading
     * @return $this
     */
    public function heading(string $heading): static
    {
        $this->withHeading = true;

        return $this->withMeta(compact('heading'));
    }

    /**
     * Display the field as raw HTML using Vue.
     *
     * @return $this
     */
    public function asHtml(): static
    {
        return $this->withMeta(['asHtml' => true]);
    }

    /**
     * Prepare the element for JSON serialization.
     *
     * @return array
     */
    public function jsonSerialize(): array
    {
        return [
            'withHeading' => $this->withHeading,
            'colors' => $this->customColors,
            ...parent::jsonSerialize()
        ];
    }

    /**
     * Custom Color for Text.
     *
     * @param string|null $color
     * @return $this
     */
    public function setTextColor(?string $color): static
    {
      $this->customColors['text'] = $color;

      return $this->colors();
    }

    /**
     * Custom Color for Background.
     *
     * @param string|null $color
     * @return $this
     */
    public function setBackgroundColor(?string $color): static
    {
      $this->customColors['background'] = $color;

      return $this->colors();
    }

    /**
     * Custom Color for Icon.
     *
     * @param string|null $color
     * @return $this
     */
    public function setIconColor(?string $color): static
    {
      $this->customColors['icon'] = $color;

      return $this->colors();
    }

    /**
     * Custom Color for Border.
     *
     * @param string|null $color
     * @return $this
     */
    public function setBorderColor(?string $color): static
    {
      $this->customColors['border'] = $color;

      return $this->colors();
    }

    /**
     * Custom Color for Border.
     *
     * @param array $colors
     * @return $this
     */
    public function setColors(array $colors): static
    {
      foreach (array_keys($this->customColors) as $key) {
        if (empty($colors[$key])) {
          continue;
        }

        $this->customColors[$key] = $colors[$key];
      }

      return $this->colors();
    }
}
