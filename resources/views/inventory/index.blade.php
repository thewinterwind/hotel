@extends('layouts.app')

@section('content')
    <div class="container">
        <form id="update_inventory" action="/inventory/update" method="POST">
            {{ csrf_field() }}
            <div class="row">
                <div class="col-md-10 col-md-offset-1 col-sm-12 col-sm-offset-0">
                    <h3>Update Room Rate & Availability</h3>
                    <br>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3 col-md-offset-1 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label for="room_type">Select Room Type:</label>
                        <select class="form-control" name="room_type">
                            @foreach ($roomTypes as $type)
                            <option name="room_type" value="{{ $type->id }}">{{ $type->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="from">From:</label>
                        <input type="text" class="datepicker form-control" name="from" value="{{ date('Y-m-d') }}" required>
                        <br>
                        <label for="to">To:</label>
                        <input type="text" class="datepicker form-control" name="to" value="{{ date('Y-m-d') }}" required>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="room_type">Refine Days:</label>
                        <div class="checkbox">
                            <div>
                                {{-- 0 is Sunday, 6 is Saturday --}}
                                <label><input name="day_range[]" value="0,1,2,3,4,5,6," type="checkbox" checked>All Days</label>
                            </div>
                            <div>
                                <label><input name="day_range[]" value="1,2,3,4,5" type="checkbox">All Weekdays</label>
                            </div>
                            <div>
                                <label><input name="day_range[]" value="1" type="checkbox">Mondays</label>
                            </div>
                            <div>
                                <label><input name="day_range[]" value="2" type="checkbox">Tuesdays</label>
                            </div>
                            <div>
                                <label><input name="day_range[]" value="3" type="checkbox">Wednesdays</label>
                            </div>
                            <div>
                                <label><input name="day_range[]" value="4" type="checkbox">Thursdays</label>
                            </div>
                            <div>
                                <label><input name="day_range[]" value="5" type="checkbox">Fridays</label>
                            </div>
                            <div>
                                <label><input name="day_range[]" value="6" type="checkbox">Saturdays</label>
                            </div>
                            <div>
                                <label><input name="day_range[]" value="0" type="checkbox">Sundays</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="room_type">Change Rate:</label>
                        <p>(leave empty to not change rate)</p>
                        <input type="number" max="2000" min="100" name="rate" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label for="room_type">Change Availability:</label>
                        <p>(leave empty to not change availability)</p>
                        <select class="form-control" name="available">
                            <option value="" selected></option>
                            <option value="1">Available</option>
                            <option value="0">Not Available</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-10 col-md-offset-1 col-sm-12 col-sm-offset-0">
                    <button id="submit-btn" type="submit" class="btn btn-default">Submit</button>
                </div>
            </div>
        </form>
        <div class="row">
            <div class="col-md-10 col-md-offset-1 col-sm-12 col-sm-offset-0">
                <hr>
                <h3>Inventory Control</h3>
                @include('partials.modal')
                <div class="monthly" id="calendar"></div>
            </div>
        </div>
    </div>
@endsection
