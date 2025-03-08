@extend('layouts.homeland')

@section('content')

    <div class="container">
        <div class="row">
            <table id="tblProperties1">
                <thead>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                </thead>
                <tbody>
                    @foreach ($properties as $property)
                    <tr>
                        <td>{{ $propery->address }}</td>
                        <td>{{ $propery->price }}</td>
                        <td>{{ $propery->listing_type->name }}</td>
                        <td>{{ $propery->offer_type }}</td>
                        <td>{{ $propery->city->name }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection
