<div>
    @if (session()->has('message'))
        <div class="alert alert-success" style="margin-top:30px;">
          {{ session('message') }}
        </div>
     @endif
    <div class="content-wrapper">
        <div class="content b-bottom pb-4">
            <div class="d-flex justify-content-between align-items-end mt-3 ">
                <h2>{{$exam[0]->name}}</h2>
                <h3>{{$exam[0]->class}}</h3>
            </div>
        </div>
        <div class="content">
            <div class="table-responsive mt-4">
                <table class="table  ">
                    <thead>
                        <tr>
                            <th scope="col">
                                <div class="d-flex justify-content-between align-items-center">
                                    {{ __('Name') }}
                                    <div class="ml-3">
                                        {{ __('Score %') }}
                                    </div>
                                </div>
                            </th>
                            @if($questions && $questions->count() > 0)
                                <?php $i = 1;?>
                                @foreach($questions as $q) 
                                    <th scope="col" class="text-center">{{$i}}</th>
                                    <?php $i++ ; ?>
                                @endforeach
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                       @if($students && $students->count() > 0)
                            @foreach($students as $student) 
                                <tr>
                                    <td>
                                        <div class="d-flex justify-content-between align-items-center">
                                            {{$student->name}}
                                            <div class="ml-3">
                                                @if($student->aproved)
                                                    <i class='fas fa-check' style='font-size:12px; color:green'></i>
                                                @endif
                                                {{$student->total}} %
                                            </div>
                                        </div>
                                    </td>
                                    @if($questions && $questions->count() > 0)
                                        @foreach($questions as $q) 
                                            <td class="p-1">
                                            @if($student->detail != null)
                                                <div class='<?php if($student->detail[$q->id]->correct): echo "green"; else: echo "red"; endif; ?> text-center' >
                                                    @if($student->detail[$q->id]->correct)
                                                        <i class='fas fa-check' style='font-size:12px; color:green'></i> 
                                                    @else
                                                        <i class='fas fa-times' style='font-size:12px; color:red'></i> 
                                                    @endif
                                                    {{$student->detail[$q->id]->answer}}
                                                <div>
                                            @endif
                                            </td>
                                        @endforeach
                                    @endif
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="5">{{_('No results')}}</td>
                            </tr> 
                        @endif 
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
