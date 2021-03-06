<?php

/*
 * *****************************************************************************
 * Contributions to this work were made on behalf of the GÉANT project, a 
 * project that has received funding from the European Union’s Framework 
 * Programme 7 under Grant Agreements No. 238875 (GN3) and No. 605243 (GN3plus),
 * Horizon 2020 research and innovation programme under Grant Agreements No. 
 * 691567 (GN4-1) and No. 731122 (GN4-2).
 * On behalf of the aforementioned projects, GEANT Association is the sole owner
 * of the copyright in all material which was developed by a member of the GÉANT
 * project. GÉANT Vereniging (Association) is registered with the Chamber of 
 * Commerce in Amsterdam with registration number 40535155 and operates in the 
 * UK as a branch of GÉANT Vereniging.
 * 
 * Registered office: Hoekenrode 3, 1102BR Amsterdam, The Netherlands. 
 * UK branch address: City House, 126-130 Hills Road, Cambridge CB2 1PQ, UK
 *
 * License: see the web/copyright.inc.php file in the file structure or
 *          <base_url>/copyright.php after deploying the software
 */

/*
  this is just an include file for Gui class definition
 */
$Faq = [
    [
        'id' => 'idp_not_listed',
        'title' => _("My organisation is not listed. Can't I just use any of the other ones?"),
        'text' => _("No! The installers contain security settings which are specific to the organisation. If you are not from that organisation, your device will detect that you are about to send your username and credential to an unauthorised server and will abort the login. Using an installer from a different organisation is <i>guaranteed to not work</i>!")
    ],
    [
        'id' => 'idp_not_listed',
        'title' => _("What can I do to get my organisation listed?"),
        'text' => sprintf(_("Contact %s administrators within your organisation and request that they add their organisation to the system. It will take at most one hour of their time to get things done."), \config\ConfAssistant::CONSORTIUM['display_name'])
    ],
    [
        'id' => 'device_not_listed',
        'title' => sprintf(_("My device is not listed! Does that mean I can't do %s?"), \config\ConfAssistant::CONSORTIUM['display_name']),
        'text' => sprintf(_("No. The CAT tool can only support Operating Systems which can be automatically configured in some way. Many other devices can still be used with %s, but must be configured manually. Please contact your organisation to get help in setting up such a device."), \config\ConfAssistant::CONSORTIUM['display_name'])
    ],
    [
        'title' => sprintf(_("I can connect to %s simply by providing username and password, what is the point of using an installer?"), \config\ConfAssistant::CONSORTIUM['display_name']),
        'text' => sprintf(_("When you are connecting from an unconfigured device your security is at risk. The very point of preconfiguration is to set up security, when this is done, your device will first confirm that it talks to the correct authentication server and will never send your password to an untrusted one."))
    ],
    [
        'title' => sprintf(_("Is it safe to use %s installers?"), \config\Master::APPEARANCE['productname']),
        'text' => sprintf(_("%s installers configure security settings on your device, therefore you should be sure that you are using genuine ones."), \config\Master::APPEARANCE['productname']) . ' ' . ( isset(\config\ConfAssistant::CONSORTIUM['signer_name']) && \config\ConfAssistant::CONSORTIUM['signer_name'] != "" ? sprintf(_("This is why %s installers are digitally signed by %s. Watch out for a system message confirming this."), \config\Master::APPEARANCE['productname'], \config\ConfAssistant::CONSORTIUM['signer_name']) : ""),
    ],
    [
        'title' => _("Windows 'SmartScreen' or 'Internet Explorer' tell me that the file is not commonly downloaded and possibly harmful. Should I be concerned?"),
        'text' => _("Contrary to what the name suggests, 'SmartScreen' isn't actually very smart. The warning merely means that the file has not yet been downloaded by enough users to make Microsoft consider it popular (which would strangely enough make it be considered 'safe'). This message alone is not a security problem.") . " " . (isset(\config\ConfAssistant::CONSORTIUM['signer_name']) && \config\ConfAssistant::CONSORTIUM['signer_name'] != "" ? sprintf(_("So long as the file is carrying a valid signature from %s, the download is safe."), \config\ConfAssistant::CONSORTIUM['signer_name']) . " " : "") . sprintf(_("Please see also Microsoft's FAQ regarding SmartScreen at %s."), "<a href='http://windows.microsoft.com/en-US/windows7/SmartScreen-Filter-frequently-asked-questions-IE9?SignedIn=1'>Microsoft FAQ</a>")
    ],
    [
        'title' => sprintf(_("I can see %s network and my device is configured but it does not connect, what can be the cause?"), \config\ConfAssistant::CONSORTIUM['display_name']),
        'text' => sprintf(_("There can be a number of different reasons. The network you see may not be a genuine %s one and your device silently drops the connection attempt; there may be something wrong with the configuration of the network; your account may have expired; there may be a connection problem with your home authentication server; you may have broken the regulations of the network you are using and have been refused access as a consequence. You should contact your organisation and report the problem, the administrators should be able to trace your connections."), \config\ConfAssistant::CONSORTIUM['display_name'])
    ],
    [
        'id' => 'contact',
        'title' => sprintf(_("I have a question about this web site. Whom should I contact?")),
        'text' => sprintf(_("You should send a mail to %s."), \config\Master::APPEARANCE['support-contact']['display'])
    ],
];

$externalDb = core\CAT::determineExternalConnection();

$SPs = $externalDb->allServiceProviders();
$consortium = \config\ConfAssistant::CONSORTIUM['display_name'];
array_push($Faq,
        [
            'id' => 'what_is_' . \config\ConfAssistant::CONSORTIUM['name'],
            'title' => sprintf(_("What is this %s thing anyway?"), $consortium),
            'text' => sprintf(_("%s is a global WiFi roaming consortium which gives members of education and research access to the internet <i>for free</i> on all %s hotspots on the planet. There are several million %s users already, enjoying free internet access on more than %d hotspots! Visit <a href='http://www.eduroam.org'>the %s homepage</a> or <a href='http://monitor.eduroam.org/map_service_loc.php'>the %s location map</a> for more details."), $consortium, $consortium, $consortium, count($SPs), $consortium, $consortium)
]);
