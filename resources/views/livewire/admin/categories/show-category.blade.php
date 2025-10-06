
<tr>
    <td>
        <input type="checkbox" class="checkbox-check"  wire:click="updateSellected({{ $item->id }})"  wire:model="mySelected" value="{{ $item->id }}" {{ in_array($mySelected, [$item->id]) ?'selected': '' }}  >
    </td>
    <td>{{ $index  }}</td>
    <td>
        {{  str_repeat('ـــ ', $item->level - 1) }}
        {{  $item->trans->where('locale',$current_lang)->first()->title }} <br>

    </td>
    <td>
        {!!  substr(removeHTML($item->trans->where('locale',$current_lang)->first()->description),0,30) !!}
    </td>
    <td>{{ $item->sort }}</td>

    <td>{{ $item->created_at }}</td>
    <td>{{ $item->updated_at }}</td>
    
    <td>
        <div class="d-flex justify-content-center">
            @can('admin.categories.update-status')
                @if($item->status == 1)
                    <a title="@lang('admin.active')" class="btn btn-xs btn-success btn-sm m-1" wire:click="update_status({{ $item->id }})"><i class="fa fa-check"></i></a>
                @else 
                    <a title="@lang('admin.dis_active')"  class="btn btn-xs btn-outline-secondary btn-sm m-1"  wire:click="update_status({{ $item->id }})"><i class="fa fa-ban"></i></a>
                @endif
            @endcan
            @can('admin.categories.update-featured')
                @if($item->feature == 1)
                    <a title="@lang('admin.feature')"  class="btn btn-xs btn-warning btn-sm m-1" wire:click="update_featured({{ $item->id }})"><i class="fa fa-star"></i></a>
                @else 
                    <a title="@lang('admin.feature')"  class="btn btn-xs btn-outline-secondary btn-sm m-1" wire:click="update_featured({{ $item->id }})"><i class="fa fa-star"></i></a>
                @endif
            @endcan
            
            <a  title="@lang('admin.show')" href="{{ route('admin.categories.show', $item->id) }}" class="btn btn-xs btn-outline-info btn-sm m-1"><i class="fas fa-eye"></i></a>


            <a title="@lang('admin.edit')" href="{{ route('admin.categories.edit', $item->id) }}"   class="btn btn-outline-primary btn-sm m-1"><i class="fas fa-pencil-alt"></i></a>
            @can('admin.categories.destroy')
                <button type="button" wire:click="deleteId({{ $item->id }})" class="btn btn-outline-danger btn-sm m-1"data-bs-toggle="modal" data-bs-target="#exampleModalLabel">
                <i class="fa fa-trash"></i>
                </button>
            @endcan

        </div>

    </td>
</tr>
