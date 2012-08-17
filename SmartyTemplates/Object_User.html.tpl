<!--SM:include file="Common_Object_Header.tpl":SM-->
    <div data-role="content">
        <ul data-role="listview" id="theobject" data-theme="d" data-divider-theme="d">
            <!--SM:foreach $renderPage as $object:SM-->
                <!--SM:if ($object@key != 'current'):SM-->
                    <!--SM:if isset($Object_User.current) && $Object_User.current.intUserID == $object.intUserID:SM-->
                        <a href="<!--SM:$SiteConfig.baseurl:SM-->?logout=1" data-role="button">Logout</a>
                    <!--SM:/if:SM-->
                    <div id="User_<!--SM:$object.intUserID:SM-->">
                        <script type="text/Javascript">
                            $(function() {
                                $('#User_<!--SM:$object.intUserID:SM--> .progressive_basic').hide();
                                $('#User_<!--SM:$object.intUserID:SM--> .readwrite').hide();
                                $('#editmode_<!--SM:$object.intUserID:SM-->').change(function(){
                                    if ($(this).val() === '1') {
                                        $('#User_<!--SM:$object.intUserID:SM--> .haseditable').hide();
                                        $('#User_<!--SM:$object.intUserID:SM--> .readwrite').show();
                                    } else {
                                        $('#User_<!--SM:$object.intUserID:SM--> .readwrite').hide();
                                        $('#User_<!--SM:$object.intUserID:SM--> .haseditable').show();
                                    }
                                });
                            });
                        </script>
                        <!--SM:if isset($object.isEditable) && count($object.isEditable) > 0:SM-->
                            <div>
                                <label for="editmode_<!--SM:$object.intUserID:SM-->">Edit mode
                                    <select name="editmode_<!--SM:$object.intUserID:SM-->" id="editmode_<!--SM:$object.intUserID:SM-->" data-role="slider">
                                        <option value="0" selected>off</option>
                                        <option value="1">on</option>
                                    </select>
                                </label>
                                <a href="<!--SM:$SiteConfig.baseurl:SM-->user/<!--SM:$object.intUserID:SM-->?HTTPaction=delete" data-role="button" data-inline="true" data-icon="delete">Delete</a>
                            </div>

                            <form action="<!--SM:$SiteConfig.baseurl:SM-->user/<!--SM:$object.intUserID:SM-->" method="post">
                        <!--SM:/if:SM--><!-- This is editable - add the form tags -->

                        <div id="intUserID">
                            <div>
                                <span class="progressive_basic">Read only: </span>
                                <label>
                                    User ID:
                                    <data>
                                        <!--SM:$object.intUserID:SM-->
                                    </data>
                                </label>
                            </div>
                        </div>

                        <!--SM:include file="Elements/TextBox.tpl" field='strUser' label=$object.labels.strUser|default:'' edit=$object.isEditable.strUser|default:array() current=$object.strUser|default:'':SM-->
                        <!--SM:include file="Elements/MultiElementFromTextBox.tpl" field='jsonLinks' label=$object.labels.jsonLinks|default:'' edit=$object.isEditable.jsonLinks|default:array() list=$object.arrLinks|default:array():SM-->
                        <!--SM:include file="Elements/Boolean.tpl" field='isWorker' label=$object.labels.isWorker|default:'' edit=$object.isEditable.isWorker|default:array() current=$object.isWorker|default:0:SM-->
                        <!--SM:include file="Elements/Boolean.tpl" field='isAdmin' label=$object.labels.isAdmin|default:'' edit=$object.isEditable.isAdmin|default:array() current=$object.isAdmin|default:0:SM-->

                        <!--SM:if isset($object.isEditable) && count($object.isEditable) > 0:SM-->
                            <div class="readwrite"><input type="submit" value="Update"/></div>
                            </form>
                            <!--SM:if isset($object.arrUserAuth) && count($object.arrUserAuth) > 0:SM-->
                                <div class="authcodes">
                                <!--SM:foreach $object.arrUserAuth as $arrUserAuth:SM-->
                                    <!--SM:if $arrUserAuth.strCleartext != '':SM-->
                                        <div class="authcode">AuthCode: <!--SM:$arrUserAuth.strCleartext:SM--></div>
                                    <!--SM:/if:SM-->
                                <!--SM:/foreach:SM-->
                                </div>
                            <!--SM:/if:SM-->
                        <!--SM:/if:SM-->
                    </div>
                    <!--SM:if isset($object.arrTalksPresenting) && count($object.arrTalksPresenting) > 0:SM-->
                        <div class="Presenting">Presenting:
                            <!--SM:foreach $object.arrTalksPresenting as $arrPresenting:SM-->
                                <a href="<!--SM:$SiteConfig.baseurl:SM-->talk/<!--SM:$arrPresenting.intTalkID:SM-->"><!--SM:$arrPresenting.strTalk:SM--></a><!--SM:if !$arrPresenting@last:SM-->, <!--SM:/if:SM-->
                            <!--SM:/foreach:SM-->
                        </div>
                    <!--SM:/if:SM-->
                    <!--SM:if isset($object.arrTalksAttending) && count($object.arrTalksAttending) > 0:SM-->
                        <div class="Attending">Attending:
                            
                            <!--SM:foreach $object.arrTalksAttending as $arrAttending:SM-->
                                <a href="<!--SM:$SiteConfig.baseurl:SM-->talk/<!--SM:$arrAttending.arrTalk.intTalkID:SM-->"><!--SM:$arrAttending.arrTalk.strTalk:SM--></a><!--SM:if !$arrAttending@last:SM-->, <!--SM:/if:SM-->
                            <!--SM:/foreach:SM-->
                        </div>
                    <!--SM:/if:SM-->
                    <!--SM:if !$object@last:SM--><hr /><!--SM:/if:SM-->
                <!--SM:/if:SM-->
            <!--SM:/foreach:SM-->
        </ul>
    </div>
<!--SM:include file="Common_Object_Footer.tpl":SM-->
