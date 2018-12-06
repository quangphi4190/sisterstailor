<div class="box-body">
    {!! Form::i18nInput('name', trans('hotel::hotels.form.name'), $errors, $lang,$hotel) !!}
    {!! Form::i18nInput('phone', trans('hotel::hotels.form.phone'), $errors, $lang,$hotel) !!}
    {!! Form::i18nInput('email', trans('hotel::hotels.form.email'), $errors, $lang,$hotel) !!}
    {!! Form::i18nInput('address', trans('hotel::hotels.form.address'), $errors, $lang,$hotel) !!}
    {!! Form::i18nInput('status', trans('hotel::hotels.form.status'), $errors, $lang,$hotel) !!}
</div>
