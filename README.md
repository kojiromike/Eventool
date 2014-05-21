Magento Event Tool
===================

Sometimes you need to inject an event observer programmatically instead of having it just sit in config.xml. For example, maybe you want to put a little something-something in the quote object during `sales_quote_save_before`, but not all the time (that event is so busy). This module consists of a helper with convenience methods for registering and disabling event observers.
