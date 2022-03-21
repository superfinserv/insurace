<?php if(session()->has('message')): ?>
        <script type="text/javascript">
            $.toast({
                                          heading: 'Success',
                                          text: "Successfully Added Record",
                                          showHideTransition: 'slide',
                                          icon: 'success',
                                          loaderBg: '#f96868',
                                          position: 'top-right'
                                        })
          
        </script>
    <?php endif ?>
    <?php if(session()->has('updatemessage')): ?>
        <script type="text/javascript">
           $.toast({
                                          heading: 'Success',
                                          text: "Successfully Update Record",
                                          showHideTransition: 'slide',
                                          icon: 'success',
                                          loaderBg: '#f96868',
                                          position: 'top-right'
                                        })
        </script>
    <?php endif ?>
    <?php if(session()->has('mailsend')): ?>
        <script type="text/javascript">
            $.toast({
                                          heading: 'Success',
                                          text: "Successfully Mail Send",
                                          showHideTransition: 'slide',
                                          icon: 'success',
                                          loaderBg: '#f96868',
                                          position: 'top-right'
                                        })
        </script>
    <?php endif ?>
    <?php if(session()->has('delete')): ?>
        <script type="text/javascript">
            $.toast({
                                          heading: 'Success',
                                          text: "Successfully Deleted Record",
                                          showHideTransition: 'slide',
                                          icon: 'success',
                                          loaderBg: '#f96868',
                                          position: 'top-right'
                                        })
        </script>
    <?php endif ?>
    <?php if(session()->has('error')): ?>
        <script type="text/javascript">
             $.toast({
                                          heading: 'Success',
                                          text: "Somethink Issues",
                                          showHideTransition: 'slide',
                                          icon: 'success',
                                          loaderBg: '#f96868',
                                          position: 'top-right'
                                        })
        </script>
    <?php endif ?>
    <?php if(session()->has('emailexist')): ?>
        <script type="text/javascript">
             $.toast({
                                          heading: 'Success',
                                          text: "Email Aready exist",
                                          showHideTransition: 'slide',
                                          icon: 'success',
                                          loaderBg: '#f96868',
                                          position: 'top-right'
                                        })
        </script>
    <?php endif ?>   