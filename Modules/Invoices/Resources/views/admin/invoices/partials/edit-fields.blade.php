<div class="box-body">
{!! Form::normalInput('customer_id', 'Customer', $errors,$invoice) !!}
    {!! Form::normalInput('tour_guide_id', 'Tour Guide', $errors,$invoice) !!}
    {!! Form::normalInput('hotel_id', 'Hotel', $errors,$invoice) !!}
    {!! Form::normalInput('order_date', 'Order date', $errors,$invoice) !!}
    {!! Form::normalInput('product', 'Product', $errors,$invoice) !!}
    {!! Form::normalInput('price', 'Price', $errors,$invoice) !!}
    {!! Form::normalInput('discount', 'Discount', $errors,$invoice) !!}
    {!! Form::normalInput('payment_type', 'Payment type', $errors,$invoice) !!}
    {!! Form::normalInput('delivery_date', 'Delivery date', $errors,$invoice) !!}
    {!! Form::normalInput('delivery_address', 'Delivery address', $errors,$invoice) !!}
    {!! Form::normalInput('delivery_name', 'Delivery name', $errors,$invoice) !!}
    {!! Form::normalInput('delivery_phone', 'Delivery phone', $errors,$invoice) !!}
    {!! Form::normalInput('delivery_note', 'Delivery note', $errors,$invoice) !!}
    {!! Form::normalInput('billing_name', 'Billing name', $errors,$invoice) !!}
    {!! Form::normalInput('billing_phone', 'Billing_phone', $errors,$invoice) !!}
    {!! Form::normalInput('status', 'Status', $errors,$invoice) !!}
    {!! Form::normalInput('note', 'Note', $errors,$invoice) !!}
</div>
