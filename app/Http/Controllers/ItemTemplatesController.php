<?php

namespace App\Http\Controllers;

use App\Models\Items;
use App\Models\ItemTemplateItems;
use App\Models\ItemTemplates;
use Illuminate\Http\Request;

class ItemTemplatesController extends Controller
{

    public function index()
    {
        $userDetails = session('user_details');

        $items = Items::get();

        $itemTemplates = ItemTemplates::get();

        foreach ($itemTemplates as $key => $template) {
            $itemTemplateItems = ItemTemplateItems::where('item_template_id', $template->item_template_id)->get();
        }

        return view('itemTemplates', ['items' => $items, 'item_templates' => $itemTemplates]);
        
    }

    // add item template
    public function addItemTemplate(Request $request)
    {
        try {
            $userDetails = session('user_details');

            $validatedData = $request->validate([
                'item_template_name' => 'required|string',
                'description' => 'nullable',
                'note' => 'nullable',
                'item_id' => 'required|integer',
                'item_qty' => 'nullable|integer',
                'item_id' => 'required|array',
                'item_qty' => 'nullable|array',
            ]);

            $itemTemplate = ItemTemplates::create([
                'added_user_id' => $userDetails['id'],
                'item_template_name' => $validatedData['item_template_name'],
                'description' => $validatedData['description'],
                'note' => $validatedData['note'],
            ]);

            if (isset($validatedData['item_id'])) {
                foreach ($validatedData['item_id'] as $key => $itemId) {
                    $itemQty = $validatedData['item_qty'][$key];

                    $itemTemplateItems = ItemTemplateItems::create([
                        'item_template_id' => $itemTemplate->item_template_id,
                        'item_id' => $itemId,
                        'item_qty' => $itemQty,
                    ]);

                }
            }

            return response()->json(['success' => true, 'message' => 'Item Template Created!'], 200);

        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 400);
        }
    }
    // add item template
}
