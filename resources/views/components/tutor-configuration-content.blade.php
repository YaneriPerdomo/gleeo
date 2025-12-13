<div class="col-10 main__content bg-white-border {{ $class }}">
    <small class="text__gray">
        @foreach ($urlsBeginningEnd as $urlBeginningEnd)
            <a href="{{ route($urlBeginningEnd['url']) }}" class="text__gray">
                {{ $urlBeginningEnd['title'] }}
            </a>
        @endforeach

    </small>
    <div class="flex-and-direction-row flex-content-space-between {{ $class }}__header">
        <span class="fs-4 {{ $class }}__title-text">
            <strong>
                {{ $title }}
            </strong>
        </span>
        <a href="{{ route($url) }}">
            <button class="button button__color-purple {{ $class }}__config-button">
                <i class="bi bi-sliders"></i> Configurar
            </button>
        </a>
    </div>
    <div class="alert alert-dark mt-2 mb-3 {{ $class }}__description" role="alert">
        <i class="bi bi-info-circle-fill"></i> {{ $paragraph }}
    </div>

    <h5 class="{{ $class }}__table-title">
        {{ $descriptionParameters }}
    </h5>

    <div class="{{ $class }}__summary-card">
        @foreach ($parameters as $parameter)
            <div class="flex-and-direction-row flex-content-space-between {{ $class }}__data-row">
                @if ($parameter['additional_column'])
                    <span>
                        <b>
                            {{ $parameter['first_column_title'] }} <br>
                        </b>{{ $parameter['first_column_title_2'] }} <br>{{ $parameter['first_column_title_3'] }}
                    </span>
                @endif

                <div class="flex-and-direction-row {{ $class }}__data-left flex-center-full">
                    <div
                        class="flex-and-direction-row {{ $class }}__metric {{ $class }}__metric--activation-limit">
                        <div class="{{ $class }}__metric-icon">
                            <i class="bi {{ $parameter['icon'] }} fs-3 text-white"></i>
                        </div>
                        <div class="{{ $class }}__metric-concept">
                            <b>
                                {{ $parameter['two_column_title'] }} <br> {{ $parameter['two_column_title_2'] }}
                            </b>
                        </div>
                    </div>
                    <div class="{{ $class }}__metric-value-container">
                        <span class="{{ $class }}__metric-value fs-2">
                            {{ $parameter['value'] }}
                        </span>
                    </div>
                </div>

                <div class="{{ $class }}__data-right flex-and-direction-row">
                    <div>
                        <b class="{{ $class }}__status-label">{{ $parameter['thre_column_title'] }}</b><br>
                        <span class="{{ $class }}__status-value">
                            {{ $parameter['thre_column_title_value'] }}
                        </span>
                    </div>
                </div>
            </div>
            @if ($parameter['additional_column'])
                <br>
            @endif
        @endforeach
    </div>
</div>
