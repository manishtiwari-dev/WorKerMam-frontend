<x-app-layout>
    @section('title', 'Update Category')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center justify-content-between ">
                        <h6 class="tx-15 mg-b-0">Update Category</h6>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('manage-landing.category.update', $category->id) }}" class="ajax-form needs-validation"
                        method="POST" id="userForm" novalidate>
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="category" class="required">{{ __('support.categoryName') }}<span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="category"
                                        class="form-control  @error('category') is-invalid @enderror"
                                        value="{{$category->category_name}}"
                                        placeholder="{{ __('support.categoryPlaceholder') }}" required>
                                    <div class="invalid-feedback">
                                        <p>{{ __('support.categoriesError') }}</p>
                                    </div>
                                </div>

                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="priority" class="priority">{{ __('support.priority') }}<span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="priority"
                                        class="form-control  @error('priority') is-invalid @enderror"
                                        value="{{$category->priority}}"
                                        placeholder="{{ __('support.priorityPlaceholder') }}" required>
                                    <div class="invalid-feedback">
                                        <p>{{ __('support.priorityError') }}</p>
                                    </div>
                                </div>
                            </div>
                             <div class="col-md-6">
                                <div class="form-group">
                                    <label for="status" class="priority">{{ __('common.status') }}<span
                                            class="text-danger">*</span></label>
                                    <select name="status" class="form-control" required>
                                        <option value="" selected disabled>{{ __('support.statusSelect') }}</option>
                                        <option value="1" {{($category->status == 1) ? 'selected' : ''}}>Active</option>
                                        <option value="0" {{($category->status == 0) ? 'selected' : ''}}>InActive</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        <p>{{ __('support.statusError') }}</p>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="mt-3">
                            <div class="col-sm-12 p-0">
                                <button type="submit" id="" class="btn btn-primary">
                                    Submit</button>
                                <a href="{{ route('manage-landing.knowledge.index') }}"
                                    class="btn btn-secondary mx-1">Cancel</a>

                            </div>
                            <!--end col-->

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    @push('scripts')
    @endpush
</x-app-layout>
