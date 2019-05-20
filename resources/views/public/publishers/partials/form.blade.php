<div class="form-group">
    <label for="name">Name</label>
    <input type="text" class="form-control {{ $errors->has('name')?"is-invalid":"" }}" id="name" name="name" placeholder="Introduce the publisher name" value="{{ isset($publisher)?$publisher->name:old('name') }}" required>
    @if( $errors->has('name'))
    <div class="invalid-feedback">
        {{ $errors->first('name') }}
    </div>
    @endif
</div>
<div class="form-group">
    <label for="url">Url</label>
    <input type="text" class="form-control {{ $errors->has('url')?"is-invalid":"" }}" id="url" name="url" placeholder="Introduce the publisher website" value="{{ isset($publisher)?$publisher->url:old('url') }}"required>
    @if( $errors->has('url'))
    <div class="invalid-feedback">
        {{ $errors->first('url') }}
    </div>
    @endif
</div>
<div class="form-group">
    <label for="email">Email</label>
    <input type="text" class="form-control {{ $errors->has('email')?"is-invalid":"" }}" id="email" name="email" placeholder="Introduce the publisher email" value="{{ isset($publisher)?$publisher->email:old('email') }}"required>
    @if( $errors->has('email'))
    <div class="invalid-feedback">
        {{ $errors->first('email') }}
    </div>
    @endif
</div>
<div class="form-group">
    <label for="address">Address</label>
    <textarea class="form-control {{ $errors->has('address')?"is-invalid":"" }}" id="address" name="address" rows="5" placeholder="Publisher Address" required>{{ isset($publisher)?$publisher->address:old('address') }}</textarea>
    @if( $errors->has('address'))
    <div class="invalid-feedback">
        {{ $errors->first('address') }}
    </div>
    @endif
</div>
