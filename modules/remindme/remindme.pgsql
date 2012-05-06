-- $Id: remindme.pgsql,v 1.1.2.1 2004/03/30 21:14:32 killes Exp $
CREATE TABLE remindme_term (
  uid integer NOT NULL default '0',
  tid integer NOT NULL default '0',
  timestamp integer NOT NULL default '0'
);
CREATE TABLE remindme_node (
  uid integer NOT NULL default '0',
  nid integer NOT NULL default '0',
  timestamp integer NOT NULL default '0'
);
