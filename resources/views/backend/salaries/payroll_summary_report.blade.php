<table>
    <thead>
    <tr>
       
        <th>Names</th>
        <th>EmployeeID</th>
        <th>Year</th>
        <th>NET</th>
        <th>Department</th>
        <th>Designation</th>
       
    </tr>
    </thead>
    <tbody>
    @foreach($payroll_summary_report as $payslips)
        <tr>
           <td>{{$payslips->employee_name}}</td>
            <td>{{$payslips->employee_id}}</td>
            <td>{{$payslips->monthYear}}</td>
            <td>{{$payslips->net}}</td>
            <td>{{$payslips->department}}</td>
            <td>{{$payslips->designation}}</td>
           
            
        </tr> 
    @endforeach
    </tbody>
</table>