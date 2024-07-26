<x-app-layout>
    <div class="container-fluid">
        <div class="layout-specing">
            <form action="{{ route('result.update', $result->id) }}" id="userForm" method="POST" class="needs-validation"
                novalidate>
                @csrf
                {{ method_field('PUT') }}
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Result Title <span class="text-danger">*</span></label>
                            <div class="form-icon position-relative">
                                <i data-feather="user" class="fea icon-sm icons"></i>
                                <input name="seo_task_title" id="seo_task_title" value="{{ $result->title_name }}"
                                    type="text" class="form-control ps-5" placeholder="Enter Your Name :" required>
                            </div>
                        </div>
                    </div>
                    <!--end col-->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Parent Title <span class="text-danger">*</span></label>
                            <select class="form-select form-control select2" name="parent_title"
                                aria-label="Default select example" required>
                                @foreach ($seoresult as $seor)
                                    <option value="{{ $seor->id }}">{{ $seor->title_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <!--end col-->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Sort Order</label>
                            <select class="form-select form-control select2" name="sort_order"
                                aria-label="Default select example" required>
                                @for ($sort = 1; $sort <= 50; $sort++)
                                    <option for="{{ $sort }}">{{ $sort }}</option>
                                @endfor

                            </select>
                        </div>
                    </div>
                    <!--end col-->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Status </label>
                            <select class="form-select form-control select2" name="status" aria-label="Default select example"
                                required>

                                <option value="1">Active</option>
                                <option value="0">InActive</option>

                            </select>
                        </div>
                    </div>
                    <!--end col-->


                </div>
                <!--end row-->
                <div class="row">
                    <div class="col-sm-12 mb-5">
                        <input type="submit" id="submit" name="send" class="btn btn-primary" value="Submit">
                    </div>
                    <!--end col-->
                </div>
                <!--end row-->
            </form>
        </div>
    </div>
</x-app-layout>
