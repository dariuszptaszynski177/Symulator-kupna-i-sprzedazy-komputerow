@foreach($offers as $offer)
                                    <tr>
                                        <td>
                                            {{$offer->id}}
                                        </td>
                                        <td>
                                            {{$offer->user_id}}
                                        </td>
                                        <td>
                                            {{$offer->computer_id}}
                                        </td>
                                        <td>
                                            {{$offer->quantity}}
                                        </td>
                                        <td>
                                            {{$offer->price}}
                                        </td>
                                        <td>
                                            <button class="btn btn-success" onclick="accept_offer({{$offer->id}}, {{$offer->user_id}}, {{$offer->computer_id}}, {{$offer->quantity}}, {{$offer->price}})">Kup</button>
                                        </td>
                                        <td>
                                            <button class="btn btn-danger" onclick="decline_offer({{$offer->id}}, {{$offer->user_id}}, {{$offer->computer_id}}, {{$offer->quantity}}, {{$offer->price}})">Odrzuć</button>
                                        </td>
                                    </tr>
                                @endforeach