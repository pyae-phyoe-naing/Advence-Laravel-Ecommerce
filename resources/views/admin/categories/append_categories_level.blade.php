<div class="form-group">
    <label>Select Category Level</label>
    <select name="parent_id" id="parent_id" class="form-control select2 @error('parent_id') is-invalid  @enderror"
        style="width: 100%;">
        <option value="0" {{ isset($categorydata->parent_id) && $categorydata->parent_id == 0 ? 'selected' : '' }}>Main Category</option>
        @if (!empty($getCategories))
            @foreach ($getCategories as $category)
                <option {{ isset($categorydata->parent_id) && $categorydata->parent_id == $category->id ? 'selected' : '' }} value="{{ $category->id }}">{{ $category->category_name }}</option>
                @if (!empty($category->subcategories))
                    @foreach ($category->subcategories as $subcat)
                        <option value="{{ $subcat->id }}">&nbsp;&raquo;&nbsp;{{ $subcat->category_name }}</option>
                    @endforeach
                @endif
            @endforeach
        @endif
    </select>
    @error('parent_id')
        <small class="text text-danger"><strong>{{ $message }}</strong></small>
    @enderror
</div>
