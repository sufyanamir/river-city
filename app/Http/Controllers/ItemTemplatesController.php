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

    // update item template
    public function updateItemTemplate(Request $request)
{
    try {
        $validatedData = $request->validate([
            'template_id' => 'required',
            'item_template_name' => 'required',
            'description' => 'nullable',
            'note' => 'nullable',
            'it_item_id' => 'nullable|array', // Changed to nullable
            'item_id' => 'nullable|array',
            'item_qty' => 'nullable|array',
        ]);

        // Retrieve the item template
        $itemTemplate = ItemTemplates::with('templateItems')->find($validatedData['template_id']);
        if (!$itemTemplate) {
            throw new \Exception('Item template not found');
        }

        // Update the item template fields
        $itemTemplate->item_template_name = $validatedData['item_template_name'];
        $itemTemplate->description = $validatedData['description'];
        $itemTemplate->note = $validatedData['note'];
        $itemTemplate->save();

        // Delete all existing item template items
        $itemTemplate->templateItems()->delete();

        // Iterate over the received item IDs and quantities
        if (!empty($validatedData['item_id'])) {
            foreach ($validatedData['item_id'] as $key => $itemId) {
                $items = ItemTemplateItems::create([
                    'item_template_id' => $validatedData['template_id'],
                    'item_id' => $itemId,
                    'item_qty' => $validatedData['item_qty'][$key],
                ]);
            }
        }

        return response()->json(['success' => true, 'message' => 'Template updated successfully'], 200);
    } catch (\Exception $e) {
        return response()->json(['success' => false, 'message' => $e->getMessage()], 400);
    }
}


    // update item template

    // delete item template
    public function getTemplateToEdit($id)
    {
        try {

            $itemTemplate = ItemTemplates::with('templateItems')->where('item_template_id', $id)->first();

            $itemIds = $itemTemplate->templateItems()->pluck('item_id')->toArray();

            $items = Items::whereIn('item_id', $itemIds)->get();

            $responseData = [
                'itemTemplate' => $itemTemplate,
                'itemsData' => $items,
            ];

            return response()->json(['success' => true, 'data' => $responseData], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 400);
        }
    }
    // delete item template

    // delete item template
    public function deleteTemplate($id)
    {
        try {

            $itemTemplate = ItemTemplates::with('templateItems')->where('item_template_id', $id)->first();

            $itemTemplate->templateItems()->delete();
            $itemTemplate->delete();

            return response()->json(['success' => true, 'message' => 'Template deleted!'], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 400);
        }
    }
    // delete item template

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
