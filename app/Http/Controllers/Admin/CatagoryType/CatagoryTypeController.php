<?php

namespace App\Http\Controllers\Admin\CatagoryType;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\CatagoriesType;
use App\Http\Requests\Admin\StoreCatagoryTypeRequest;
use App\Http\Requests\Admin\UpdateCatagoryTypeRequest;
use Session;

class CatagoryTypeController extends Controller
{
	public function index()
	{
		$catagoryTypes = CatagoriesType::latest()->paginate();
		return view('admin.catagories_types.index', compact('catagoryTypes'));
	}

	public function create()
	{
		return view('admin.catagories_types.create');
	}

	public function store(StoreCatagoryTypeRequest $request)
	{
		$data = $request->all();
		$data['slug'] = $request->name;
		// dd($data);
		CatagoriesType::create($data);
		Session::flash('success', 'Tạo loại danh mục thành công');
		return redirect()->route('admin.catagory-types.index');
	}

	public function edit(CatagoriesType $catagoryType)
	{
		return view('admin.catagories_types.edit', compact('catagoryType'));
	}

	public function update(CatagoriesType $catagoryType, UpdateCatagoryTypeRequest $request)
	{
		$data = $request->all();
		$data['slug'] = $request->name;
		// dd($data);
		$catagoryType->update($data);
		Session::flash('success', 'Cập nhật loại danh mục thành công');
		return redirect()->route('admin.catagory-types.index');
	}

	public function destroy(CatagoriesType $catagoryType)
	{
		$catagoryType->delete();
		Session::flash('success', 'Xoá loại danh mục thành công');
		return redirect()->route('admin.catagory-types.index');
	}
}
