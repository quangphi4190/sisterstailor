<?php $i = 0; ?>
@foreach (LaravelLocalization::getSupportedLocales() as $locale => $language)
    <?php $i++; ?>
    <div class="tab-pane {{ locale() == $locale ? 'active' : '' }}" id="tab_{{ $i }}">
    <input hidden name = "id" value ="<?php echo $customer->id?>">
        @include('customers::admin.customers.partials.edit-fields', ['lang' => $locale])
    </div>
@endforeach



