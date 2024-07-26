<?php

namespace Modules\Setting\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Setting\Models\CustomForm;
use Modules\Setting\Models\CustomFormField;
use Illuminate\Support\Str;
// use Auth;

class CustomFormController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $custom_form = CustomForm::orderBy('created_at', 'DESC')->paginate(100);
        $custom_form_field = CustomFormField::all();
        return view('Setting::customform.index', compact('custom_form', 'custom_form_field'));

    }
    


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()

    {

        return view('Setting::customform.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
        $custom_form = new CustomForm();
        $custom_form->form_name = $request->form_name;
        $custom_form->form_shortcode = $request->form_shortcode;
        $custom_form->form_type = $request->form_type;
        $custom_form->status = 1;
        $custom_form->save();

        $current_form_id = $custom_form->form_id;

        for ($col = 0; $col < count($request->field_label); $col++) {
            $test = [
                'form_id' => $current_form_id,
                'field_label' => $request->field_label[$col],
                'field_name' => Str::slug($request->field_label[$col], '-'),
                'field_type' => $request->field_type[$col],
                'field_class' => $request->field_class[$col],
                'sort_order' => $request->sort_order[$col],
                'required' => $request->required[$col],

            ];
            CustomFormField::create($test);
        }


        return redirect()->route('custom-form.index')->with('success', 'Custom Form Added successfully');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $custom_form = CustomForm::find($id);
        $custom_form_field = CustomFormField::where('form_id', $custom_form->form_id)->get();
      
        return view('Setting::customform.edit', compact('custom_form', 'custom_form_field'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {


        $custom_form =  CustomForm::find($id);
        $custom_form->form_name = $request->form_name;
        $custom_form->form_shortcode = $request->form_shortcode;
        $custom_form->form_type = $request->form_type;
        $custom_form->update();
 
        $current_form_id = $custom_form->form_id;
        $test  = [];
        for ($col = 0; $col < count($request->field_label); $col++) {

            CustomFormField::where('form_id', $current_form_id)->delete();

            $test = [
                'form_id' => $current_form_id,
                'field_label' => $request->field_label[$col],
                'field_name' => Str::slug($request->field_label[$col], '-'),
                'field_type' => $request->field_type[$col],
                'field_class' => $request->field_class[$col],
                'sort_order' => $request->sort_order[$col],
                'required' => $request->required[$col],
            ];
            CustomFormField::create($test);
        }


        return redirect()->route('custom-form.index')->with('success', 'Custom Form Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)

    {
        $custom_form = CustomForm::find($id);
        $custom_form->delete();
        return redirect()->route('custom-form.index')->with('success', 'Custom Form delete successfully');
    }


    public function changeStatus(Request $request)
    {


        $custom = CustomForm::where('form_id', $request->status_id)->first();

        if ($custom->status == 1) {
            $custom->status = 0;
        } else {
            $custom->status = 1;
        }
        $custom->save();

        return response()->json(['success' => 'Status change successfully.']);
    }

    
}
