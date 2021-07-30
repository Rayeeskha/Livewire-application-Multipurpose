<?php

namespace App\Http\Livewire\Admin\Users;

use Livewire\Component;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class ListUsers extends Component
{
	public $state = [];
    public $showEditModal = false;
    public $user;
    public $userIdBeingRemoved;
	public function addNew(){
        $this->reset();
        $this->showEditModal = false;
    	$this->dispatchBrowserEvent('show-form');
    }

    public function createUser(){
    	$validatedData = Validator::make($this->state, [
			'name' => 'required',
			'email' => 'required|email|unique:users',
			'password' => 'required|confirmed',
		])->validate();

		$validatedData['password'] = bcrypt($validatedData['password']);
        // if ($this->photo) {
        //     $validatedData['avatar'] = $this->photo->store('/', 'avatars');
        // }
        User::create($validatedData);
        $this->dispatchBrowserEvent('hide-form', ['message' => 'User added successfully!']);
    }

    public function edit(User $user){
        $this->reset();
        $this->showEditModal = true;
        $this->user = $user;
        $this->state = $user->toArray();
        $this->dispatchBrowserEvent('show-form');
    }

    public function updateUser(){
        $validatedData = Validator::make($this->state, [
            'name'     => 'required',
            'email'    => 'required|email|unique:users,email,'.$this->user->id,
            'password' => 'sometimes|confirmed',
        ])->validate();
        if(!empty($validatedData['password'])) {
            $validatedData['password'] = bcrypt($validatedData['password']);
        }
        // if ($this->photo) {
        //     Storage::disk('avatars')->delete($this->user->avatar);
        //     $validatedData['avatar'] = $this->photo->store('/', 'avatars');
        // }

        $this->user->update($validatedData);
        $this->dispatchBrowserEvent('hide-form', ['message' => 'User updated successfully!']);
    }



    public function render(){
        $users = User::latest()->paginate();
        return view('livewire.admin.users.list-users', compact('users'));
    }

    public function confirmUserRemoval($userId){
        $this->userIdBeingRemoved = $userId;
        $this->dispatchBrowserEvent('show-delete-modal');
    }

    public function deleteUser(){
        $user = User::findOrFail($this->userIdBeingRemoved);
        $user->delete();
        $this->dispatchBrowserEvent('hide-delete-modal', ['message' => 'User deleted successfully!']);
    }








}
