@foreach($users as $user)
                            <tr>
                                <td>{{$user->id}}</td>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                @if($user->active!=0)
                                    <td>
                                        <label class="switch">
                                            <?php 
                                                $value = 1;
                                            ?>
                                            <input type="checkbox" checked onclick="update_status({{$user->id}}, <?php echo $value; ?>)">
                                            <span class="slider round"></span>
                                        </label>
                                    </td>
                                @else
                                    <td>
                                        <label class="switch">
                                        <?php 
                                                $value = 0;
                                            ?>
                                            <input type="checkbox" onclick="update_status({{$user->id}}, <?php echo $value; ?>)">
                                            <span class="slider round"></span>
                                        </label>
                                    </td>
                                @endif
                            </tr>
                            @endforeach
                            