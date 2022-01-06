@foreach($other_offers as $other_offer)
                                    <tr>
                                        <td>
                                            {{$other_offer->id}}
                                        </td>
                                        <td>
                                            {{$other_offer->user_id}}
                                        </td>
                                        <td>
                                            {{$other_offer->computer_id}}
                                        </td>
                                        <td>
                                            {{$other_offer->quantity}}
                                        </td>
                                        <td>
                                            {{$other_offer->price}}
                                        </td>
                                        <td>
                                            <button class="btn btn-danger" onclick="decline_other_offer({{$other_offer->id}}, {{$other_offer->user_id}}, {{$other_offer->computer_id}}, {{$other_offer->quantity}}, {{$other_offer->price}})">Odrzuć</button>
                                        </td> 
                                    </tr>
                                @endforeach