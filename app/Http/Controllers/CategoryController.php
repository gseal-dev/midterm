<?php
namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::orderBy('id','desc')->get();
        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        // ✅ Validate name + description
        $data = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
            'description' => 'nullable|string',
        ]);

        // ✅ Save category
        Category::create($data);

        return redirect()->route('categories.index')->with('success','Category created.');
    }

    public function show(Category $category)
    {
        return redirect()->route('categories.index');
    }

    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        // ✅ Validate name + description
        $data = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $category->id,
            'description' => 'nullable|string',
        ]);

        // ✅ Update category
        $category->update($data);

        return redirect()->route('categories.index')->with('success','Category updated.');
    }

    public function destroy(Category $category)
    {
        // will cascade delete products because of migration constraint
        $category->delete();
        return redirect()->route('categories.index')->with('success','Category deleted.');
    }
}
