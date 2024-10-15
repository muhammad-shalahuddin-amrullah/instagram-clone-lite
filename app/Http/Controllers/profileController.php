<?php
namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class profileController extends Controller
{
    public function index($username)
    {
        $user = User::where('username', $username)->first();
        if (!$user) {
            abort(404);
        }
        return view('profile', compact('user'));
    }

    public function update(Request $request, $username)
    {
        $user = auth()->user();
        
        if ($request->has('username') && $request->input('username')!== $username) {
            $validatedUsername = $request->validate([
                'username' =>'required|string|unique:users,username,'.$user->id,
            ]);
            
            $user->username = $validatedUsername['username'];
            $user->save();
        }
    
        if ($request->has('name') || $request->has('bio')) {
            $validatedData = $request->validate([
                'name' =>'required|string',
                'bio' => 'nullable|string',
            ]);
            
            $user->update($validatedData);
        }
    
        if ($request->has('profile_picture')) {
            $validatedImage = $request->validate([
                'profile_picture' =>'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
            
            $imageName = time().'.'.$validatedImage['profile_picture']->extension();  
            $validatedImage['profile_picture']->move(public_path('images'), $imageName);
            $user->profile_picture = 'images/'.$imageName;
            $user->save();
        }
        return redirect()->route('profile.index', $user->username);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login.index');
    }

}
