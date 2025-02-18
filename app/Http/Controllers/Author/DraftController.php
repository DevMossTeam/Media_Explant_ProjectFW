<?php

namespace App\Http\Controllers\Author;

use App\Http\Controllers\Controller;
use App\Models\Author\DraftMedia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DraftController extends Controller
{
    public function index(Request $request)
    {
        $query = DraftMedia::query();

        // Filter berdasarkan sort
        if ($request->has('sort')) {
            $query->orderBy('created_at', $request->get('sort') === 'oldest' ? 'asc' : 'desc');
        }

        // Filter berdasarkan visibility
        if ($request->has('visibility')) {
            $query->where('visibilitas', $request->get('visibility'));
        }

        // Paginate hasil (tetap kirimkan meskipun kosong)
        $articles = $query->paginate(10);

        return view('authors.draft', compact('articles'));
    }

    public function destroy($id)
    {
        $article = DraftMedia::findOrFail($id);

        if ($article->user_id !== Auth::id()) {
            return redirect()->route('author.draft.index')->withErrors('Anda tidak memiliki izin untuk menghapus Media ini.');
        }

        $article->delete();

        return redirect()->route('author.draft.index')->with('success', 'Media berhasil dihapus.');
    }
}
