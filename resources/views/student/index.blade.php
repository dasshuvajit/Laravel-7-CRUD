@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @if(Session::has('success') )
                <div class="div alert alert-success"> {{ Session::get('success') }} </div>
            @endif
            <div class="card">
                <div class="card-header bg-primary text-light d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">All Students</h5>
                    <a href="{{ route('student.create') }}" class="btn btn-light">Create Student</a>
                </div>

                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th> Id </th>
                                <th> Name </th>
                                <th> Email </th>
                                <th> Action </th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($students->count() > 0)
                                @foreach($students as $student)
                                <tr>
                                    <td> {{ $student->id }} </td>
                                    <td> {{ $student->name }} </td>
                                    <td> {{ $student->email }} </td>
                                    <td class="d-flex">
                                        <a href="{{ route('student.edit', ['id' => $student->id]) }}" class="btn btn-primary btn-sm"> Edit </a>
                                        <!--<a href="{{ route('student.destroy', ['id' => $student->id]) }}" class="btn btn-danger btn-sm"> Delete </a>-->
                                        <form action="{{ route('student.destroy') }}" method="post" class="ml-2">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $student->id }}">
                                            <button type="submit" class="btn btn-danger btn-sm"> Delete </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            @else
                            <tr>
                                <td colspan="4">
                                    <h5 class="text-center mt-3">No Data Found</h5>
                                </td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
