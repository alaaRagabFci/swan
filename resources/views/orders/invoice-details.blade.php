@foreach ($tableData_->getData()->data as $row)
  <tr>
    <td>{!! $row->getServiceTypes !!}</td>
    <td>{!! $row->getAirTypes !!}</td>
    <td>{!! $row->air_number !!}</td>
  </tr>
@endforeach