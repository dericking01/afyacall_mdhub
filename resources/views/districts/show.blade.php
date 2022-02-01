@extends('layouts.app')
@section('content')

<div class="card">
    <div class="card-header">
        <h4 class="card-title">{{ $district->name }} District<h4>
    </div>

    <div class="card-body">
        <div class="mb-2">
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            ID
                        </th>
                        <td>
                            {{ $district->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Name
                        </th>
                        <td>
                            {{ $district->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Region
                        </th>
                        <td>
                            {{ $district->region->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Wards
                        </th>
                        <td>
                            @if(!$district->wards->isEmpty())
                                @foreach ($district->wards as $ward)
                                {{ $ward->name."," }}
                                @endforeach
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
            <a style="margin-top:20px;" class="btn btn-default" href="{{ route("admin.districts.index") }}">
                {{ trans('global.back_to_list') }}
            </a>
        </div>


    </div>
</div>
@endsection