<div class="form-group">
    <label for="from">Room Number</label>
    <input type="text" class="form-control" value="{{ $number }}" readonly>
</div>
<div class="form-group">
    <label for="from">Date</label>
    <input type="text" class="form-control" name="date" value="{{ $date }}" readonly>
</div>
<div class="form-group">
    <label for="from">Rate</label>
    <input type="number" name="rate" min="0" max="2000" class="form-control" value="{{ $rate }}">
</div>
<div class="form-group">
    <label for="from">Available</label>
    <select class="form-control" name="available">
        <option value="1"{{ $available ? ' selected' : '' }}>Available</option>
        <option value="0"{{ !$available ? ' selected' : '' }}>Not Available</option>
    </select>
</div>
