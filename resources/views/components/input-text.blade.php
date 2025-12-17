<div class="form__item {{ $item['additional_class'] ?? '' }}">
    <label for="{{ $item['form_input_name'] }}" class="form__label">{{ $item['form_title'] }}</label>
    <div class="input-group">
        <span class="form__icon input-group-text @error($item['form_input_name']) is-invalid--border @enderror">
            <i class="bi {{ $item['icon'] }} "></i>
        </span>
        <input type="{{ $item['type'] }}" name="{{ $item['form_input_name'] }}" id="{{ $item['form_input_name'] }}"
            class="form-control @error($item['form_input_name']) is-invalid @enderror"
            placeholder="Ej: {{ $item['placeholder'] }}" aria-label="{{ $item['aria_label'] }}"
            value="{{ old( $item['form_input_name'] , $item['form_input_value_default'] ) }}" {!! $item['attribute_a'] !!}>
    </div>
    @error($item['form_input_name'])
    <div class="alert alert-danger mt-1">{{ $message }}</div>
    @enderror
    @if($item['form_help_text'] != '')
    <div class="form__help text-muted mt-1">
        <small>{{ $item['form_help_text'] }}</small>
    </div>
    @endif
</div>
