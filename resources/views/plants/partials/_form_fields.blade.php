@props(['plant' => null, 'buttonText' => 'Save'])

<!-- Name Field -->
<div class="mb-3">
    <label for="name" class="form-label">Plant Name</label>
    <input type="text" name="name" id="name" 
           class="form-control @error('name') is-invalid @enderror" 
           value="{{ old('name', $plant->name ?? '') }}" required>
    @error('name')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<!-- Type Field -->
<div class="mb-3">
    <label for="type" class="form-label">Plant Type</label>
    <select name="type" id="type" class="form-select @error('type') is-invalid @enderror" required>
        <option value="">Select Type</option>
        @foreach(['flower', 'succulent', 'tree', 'herb', 'shrub'] as $type)
            <option value="{{ $type }}" {{ old('type', $plant->type ?? '') == $type ? 'selected' : '' }}>
                {{ ucfirst($type) }}
            </option>
        @endforeach
    </select>
    @error('type')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<!-- Price Field -->
<div class="mb-3">
    <label for="price" class="form-label">Price ($)</label>
    <div class="input-group">
        <span class="input-group-text">$</span>
        <input type="number" step="0.01" min="0" name="price" id="price" 
               class="form-control @error('price') is-invalid @enderror" 
               value="{{ old('price', $plant->price ?? '') }}" required>
        @error('price')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>

<!-- Environment Field -->
<div class="mb-3">
    <label class="form-label">Environment</label>
    <div class="btn-group" role="group">
        @foreach(['indoor', 'outdoor', 'both'] as $env)
            <input type="radio" class="btn-check" name="environment" 
                   id="env_{{ $env }}" value="{{ $env }}" 
                   {{ old('environment', $plant->environment ?? '') == $env ? 'checked' : '' }} required>
            <label class="btn btn-outline-primary" for="env_{{ $env }}">
                {{ ucfirst($env) }}
            </label>
        @endforeach
    </div>
    @error('environment')
        <div class="text-danger small mt-1">{{ $message }}</div>
    @enderror
</div>

<!-- Description Field -->
<div class="mb-3">
    <label for="description" class="form-label">Description</label>
    <textarea name="description" id="description" rows="3"
              class="form-control @error('description') is-invalid @enderror">{{ old('description', $plant->description ?? '') }}</textarea>
    @error('description')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<!-- Image Upload -->
<div class="mb-3">
    <label for="image" class="form-label">Plant Image</label>
    <input type="file" name="image" id="image" 
           class="form-control @error('image') is-invalid @enderror">
    @error('image')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
    @if($plant->image ?? false)
        <div class="mt-2">
            <small>Current Image:</small>
            <img src="{{ asset('storage/' . $plant->image) }}" width="100" class="mt-1">
        </div>
    @endif
</div>

<!-- Form Actions -->
<div class="d-flex justify-content-between mt-4">
    <a href="{{ route('plants.index') }}" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left"></i> Cancel
    </a>
    <button type="submit" class="btn btn-primary">
        <i class="bi bi-save"></i> {{ $buttonText }}
    </button>
</div>