@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col mb-4">
                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#createModal">
                    Add course
                </button>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col">
                <table id="courses">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($courses as $course)
                        <tr>
                            <td>{{$course->name}}</td>
                            <td>
                                <a href="{{route('courses.chapters', $course)}}" class="btn btn-info">More</a>
                                <button class="btn btn-light" data-toggle="modal" data-target="#editModal"
                                        data-path="{{route('courses.update', $course)}}"
                                        data-params="{{$course->toJson()}}">
                                    Edit
                                </button>
                                <button class="btn btn-danger"
                                        onclick="event.preventDefault();document.getElementById('delete-form-{{$course->id}}').submit();">
                                    Delete
                                </button>
                                <form method="post" id="delete-form-{{$course->id}}" action="{{route('courses.delete',
                            $course)}}">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>

    <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <form method="post" action="{{route('courses.store')}}">
                        @csrf
                        <div class="form-group">
                            <label>Course name</label>
                            <input type="text" class="form-control" name="name">
                        </div>
                        <div class="form-group">
                            <label>Cost</label>
                            <input type="text" class="form-control" name="cost">
                        </div>
                        <button type="submit" class="btn btn-info">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <form method="post" class="modal-form" action="">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="name">Course name</label>
                            <input type="text" class="form-control" id="name" name="name">
                        </div>
                        <div class="form-group">
                            <label for="cost">Cost</label>
                            <input type="text" class="form-control" id="cost" name="cost">
                        </div>
                        <button type="submit" class="btn btn-info">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready( function () {
            $('#courses').DataTable();
        } );
        $('#editModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget)
            var path = button.data('path')
            var params = button.data('params')
            var modal = $(this)
            modal.find('.modal-form').attr('action', path)
            modal.find('#name').val(params.name)
            modal.find('#cost').val(params.cost)
        })
    </script>
@endsection
