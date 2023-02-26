<div>
     <ul class="list-group w-75 mx-auto mt-3 container-fluid">
          @forelse($users as $user)
          <li wire:click="checkConversation({{ $user->id }})" class="list-group-item list-group-item-action"> {{ $user->name }}</li>
          @empty
               <h2>No Users found ☹</h2>
          @endforelse
     </ul>
</div>
