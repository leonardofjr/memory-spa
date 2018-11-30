@if(strtolower($value) == $data->type)
    <option selected value={{strtolower($value)}}>{{$value}}</option>
@else
    <option value={{strtolower($value)}}>{{$value}}</option>
@endif
