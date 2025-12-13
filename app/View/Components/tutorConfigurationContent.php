<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class tutorConfigurationContent extends Component
{
    public $descriptionParameters;
    public $class;
    public $title;
    public $paragraph;
    public $parameters;
    public $url;
    public $urlsBeginningEnd;

    public function __construct(
        string $descriptionParameters,
        string $class,
        string $title,
        string $paragraph,
        array $parameters,
        string $url,
        array $urlsBeginningEnd
    ) {
        // En este ejemplo, el nombre de la variable en el constructor es camelCase.
        // PHP y Laravel se encargarán de mapear el atributo HTML 'description-parameters' a '$descriptionParameters'
        $this->descriptionParameters = $descriptionParameters;
        $this->class = $class;
        $this->title = $title;
        $this->paragraph = $paragraph;
        $this->parameters = $parameters;
        $this->url = $url;
        $this->urlsBeginningEnd =$urlsBeginningEnd;
    }


    public function render(): View|Closure|string
    {
        return view('components.tutor-configuration-content');
    }
}
