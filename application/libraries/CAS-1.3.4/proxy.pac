function FindProxyForURL(url, host) {

	// -----
	// report du proxy.pac du CRI http://cri.univ-fcomte.fr/pac/proxy.pac
	// 20151211
	// url  : URL complète demandée
	// host : hôte de l'URL
	// test avec pacparser-master/pactester
	// -----

	var myip = myIpAddress();
	var hostIP = 0;
	if (isResolvable(host)) { hostIP = dnsResolve(host); } else { hostIP = host; }

 	// -----
	// Force le proxy pour Scd
	// -----
	if (dnsDomainIs(host, "scd1.univ-fcomte.fr")) { return "PROXY proxy-web.univ-fcomte.fr:3128"; }
 
	// -----
	// Direct pour Ufr SLHS
	// -----
	if (dnsDomainIs(host, "umrthema")) { return "DIRECT"; }

	// -----
	// Direct pour Ufr SMP
	// -----
	if (shExpMatch(url, "http://wchub*")) { return "DIRECT"; }
	if (shExpMatch(url, "http://pchub*")) { return "DIRECT"; }
	if (shExpMatch(url, "http://wrh*"))   { return "DIRECT"; }
	if (isInNet(hostIP, "172.20.18.238", "255.255.255.255")) { return "DIRECT"; }

	// -----
	// direct pour cnrs
	// -----
	if (shExpMatch(url, "https://intranet.utinam.cnrs.fr*")) { return "DIRECT"; }

	// -----
	// Direct pour Ufr ST
	// -----
	if (dnsDomainIs(host, "stsg.fr1")) { return "DIRECT"; }
	
	// ----- 
	// Direct pour Ufr STGI
	// -----
	if (isInNet(host, "172.20.170.1", "255.255.254.0")) { return "DIRECT"; }

	// -----
	// Direct pour Cla
	// -----
	if (isInNet(host, "172.20.19.128", "255.255.255.128")) { return "DIRECT"; }

	// -----
	// Direct pour Iut 25
	// -----
	if (isInNet(host, "172.20.3.0",   "255.255.255.0")) { return "DIRECT"; }
	if (isInNet(host, "172.20.56.0",  "255.255.252.0")) { return "DIRECT"; }
	if (isInNet(host, "172.20.137.0", "255.255.255.0")) { return "DIRECT"; }
	if (isInNet(host, "172.20.148.0", "255.255.254.0")) { return "DIRECT"; }

	// -----
	// Direct pour Iut 70
	// -----
	if (isInNet(host, "172.20.48.0",  "255.255.254.0"))   { return "DIRECT"; }
	if (isInNet(host, "172.20.180.0", "255.255.255.0"))   { return "DIRECT"; }
	if (isInNet(host, "172.20.181.0", "255.255.255.192")) { return "DIRECT"; }

	// -----
	// Direct pour Iut 70
	// -----
	if (dnsDomainIs(host, ".stgibm.univ-fcomte.fr")) { return "DIRECT"; } 

	// -----
	// Direct pour Sig
	// -----
	if (dnsDomainIs(host, "goudidom.local")) { return "DIRECT"; }

	// -----
	// Direct pour Formation Continue
	// -----
	if (dnsDomainIs(host, "fc.local")) { return "DIRECT"; }

	// -----
	// Direct pour SCD
	// -----
	if (dnsDomainIs(host, "belfort.scd")) { return "DIRECT"; }

	// -----
	// Direct pour Femto
	// -----
	if (dnsDomainIs(host, ".femto-st.fr")) { return "DIRECT"; }

	// -----
	// Direct pour MSHE
	// -----
	if (dnsDomainIs(host, "mshe.univ-fcomte.fr")) { return "DIRECT"; }

	// -----
	// Direct pour Géosciences
	// -----
	if (isInNet(host, "172.20.68.128", "255.255.255.128")) { return "DIRECT"; }

	// -----
	// Direct pour Chrono-Environnement
	// -----
	if (isInNet(host, "172.20.124.0",  "255.255.254.0"))   { return "DIRECT"; }
	if (isInNet(host, "194.57.87.128", "255.255.255.192")) { return "DIRECT"; }

	// -----
	// Direct UPFR SPORT
	// -----
	if (isInNet(host, "172.20.138.0", "255.255.255.0")) { return "DIRECT"; }

	// ----- 
	// Direct pour le Wifi (Aruba)
	// -----
	if (shExpMatch(url, "*securelogin.arubanetworks.com:443*")) { return "DIRECT"; }
	if (shExpMatch(url, "*securelogin.arubanetworks.com*"))     { return "DIRECT"; }

	// -----
	// Direct pour eduroam
	// -----
	if (isInNet(myip, "172.21.64.0",   "255.255.240.0")) { return "DIRECT"; }
	if (isInNet(myip, "172.21.80.0",   "255.255.248.0")) { return "DIRECT"; }

	// -----
	// Direct pour eduroam Huawei
	// -----
	if (isInNet(myip, "172.21.192.0",   "255.255.240.0")) { return "DIRECT"; }

	// -----
	// Direct pour sides
	// -----
	if (isInNet(myip, "172.21.88.0",   "255.255.253.0")) { return "DIRECT"; }

	// -----
	// Direct pour sides Huawei
	// -----
	if (isInNet(myip, "172.21.210.0",   "255.255.253.0")) { return "DIRECT"; }

	// -----
	// Direct pour evenement
	// -----
	if (isInNet(myip, "172.21.90.0",   "255.255.253.0")) { return "DIRECT"; }

	// -----
	// Direct pour evenement Huawei
	// -----
	if (isInNet(myip, "172.21.214.0",   "255.255.253.0")) { return "DIRECT"; }

	// ----- 
	// Direct pour le VPN @ufc
	// -----
	if (isInNet(myip, "172.20.252.0",   "255.255.255.0")) { return "DIRECT"; }

	// -----
	// Vers les serveurs UFC
	// -----
	if (isInNet(hostIP, "192.168.0.0",   "255.255.0.0")) 	{ return "DIRECT"; }
	if (isInNet(hostIP, "172.20.0.0",    "255.255.0.0")) 	{ return "DIRECT"; }
	if (isInNet(hostIP, "193.52.61.0",   "255.255.255.0")) 	{ return "DIRECT"; }
	if (isInNet(hostIP, "193.52.184.0",  "255.255.254.0")) 	{ return "DIRECT"; }
	if (isInNet(hostIP, "193.52.75.0",   "255.255.255.0")) 	{ return "DIRECT"; }
	if (isInNet(hostIP, "193.55.65.0",   "255.255.255.0")) 	{ return "DIRECT"; }
	if (isInNet(hostIP, "193.55.66.0",   "255.255.254.0")) 	{ return "DIRECT"; }
	if (isInNet(hostIP, "193.55.68.0",   "255.255.252.0")) 	{ return "DIRECT"; }
	if (isInNet(hostIP, "193.55.148.0",  "255.255.252.0")) 	{ return "DIRECT"; }
	if (isInNet(hostIP, "194.57.76.0",   "255.255.252.0")) 	{ return "DIRECT"; }
	if (isInNet(hostIP, "194.57.80.0",   "255.255.248.0")) 	{ return "DIRECT"; }
	if (isInNet(hostIP, "194.57.88.0",   "255.255.252.0")) 	{ return "DIRECT"; }
	if (isInNet(hostIP, "194.199.178.0", "255.255.254.0")) 	{ return "DIRECT"; }
	if (isInNet(hostIP, "194.199.180.0", "255.255.254.0")) 	{ return "DIRECT"; }
	if (isInNet(hostIP, "195.83.18.0",   "255.255.254.0")) 	{ return "DIRECT"; }
	if (isInNet(hostIP, "195.83.112.0",  "255.255.254.0")) 	{ return "DIRECT"; }
	if (isInNet(hostIP, "195.220.182.0", "255.255.254.0")) 	{ return "DIRECT"; }
	if (isInNet(hostIP, "195.220.184.0", "255.255.254.0")) 	{ return "DIRECT"; }
	if (isInNet(hostIP, "195.221.254.0", "255.255.254.0")) 	{ return "DIRECT"; }

	// -----
	// hebergement en dehors de l'UFC avec un nom en univ-fcomte.fr : wouhou la fête du slip !
	// -----
	if (shExpMatch(host, "oae.univ-fcomte.fr*")) { }
	else {

	 	// -----
		// Direct pour Ufc
		// -----
		if (dnsDomainIs(host, "univ-fcomte.fr") && !shExpMatch(host, "oae.univ-fcomte.fr")) { return "DIRECT"; }
		if (shExpMatch(url, "http://localhost*")) { return "DIRECT"; }
		if (shExpMatch(url, "http://127.0.0.1*")) { return "DIRECT"; }

	}

	// -----
	// Vers le proxy par defaut pour les autres destinations
	// -----

	if (isInNet(myip, "172.20.192.128", "255.255.255.128")) {
		return "PROXY 172.20.192.213:3128";
	}
	if (isInNet(myip, "172.20.194.0", "255.255.255.0")) {
		return "PROXY 172.20.194.193:3128";
	}
	if (isInNet(myip, "194.57.89.192", "255.255.255.192")) {
		return "PROXY 194.57.89.193:3128";
	}
	return "PROXY 172.20.255.89:3128"

}
