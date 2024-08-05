@if(count($applications) > 0)
<table class="table table-hover table-striped">
    <tbody>
            @foreach ($applications as $application)
            <tr>
                <td>
                    <div class="icheck-primary">
                        <input type="checkbox" class="checkbox-id" value="{{ $application->id }}" data-delete-url="{{ route('admin.application.delete', $application->id) }}" id="check{{ $application->id }}">
                        <label class="selected" for="check{{ $application->id }}"></label>
                    </div>
                </td>
                {{-- <td class="mailbox-name"><a href="{{ route('admin.application.show', $application->id) }}">{{ $application->name }}</a></td> --}}
                <td class="mailbox-subject">{{ $application->name }} {{ $application->email }} {{ $application->phone }}</td>
                <td class="mailbox-date">{{ $application->SetCreatedDate() }}</td>
            </tr>
            {{-- @dump($application->files) --}}
            @endforeach
    </tbody>
</table>
@else
    <h3 style="text-align: center">Пусто</h3>
@endif