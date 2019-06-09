@foreach ($tableData_->getData()->data as $row)
    <tr>
        <td>{{  $row->id }}</td>
        <td>{{  $row->company }}</td>
        <td>{{  $row->application }}</td>
        <td>{{  $row->rate }}</td>
        <td>{{  $row->comment }}</td>
    </tr>
@endforeach