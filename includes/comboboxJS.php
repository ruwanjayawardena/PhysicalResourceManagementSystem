<script type="text/javascript">
	//Load Combo Box Functions      

	function cmbProvince(selected, callback) {
		var cmbdata = "";
		$.post('controllers/provinceController.php', {action: 'cmbProvince'}, function (e) {
			if (e === undefined || e.length === 0 || e === null) {
				cmbdata += '<option value="0"> Province not available! </option>';
			} else {
				$.each(e, function (index, qdt) {
					if (selected !== undefined || selected !== null || parseInt(selected) > 0) {
						if (parseInt(selected) === parseInt(qdt.prov_id)) {
							cmbdata += '<option value="' + qdt.prov_id + '" selected>' + qdt.prov_name + '</option>';
						} else {
							cmbdata += '<option value="' + qdt.prov_id + '">' + qdt.prov_name + '</option>';
						}
					} else {
						cmbdata += '<option value="' + qdt.prov_id + '">' + qdt.prov_name + '</option>';
					}
				});
			}
			$('.cmbProvince').html('').append(cmbdata);
			chosenRefresh();

			if (callback !== undefined) {
				if (typeof callback === 'function') {
					callback();
				}
			}
		}, "json");
	}


	function cmbZonal(zol_province, selected, callback) {
		var cmbdata = "";
		$.post('controllers/zonalController.php', {action: 'cmbZonal', zol_province: zol_province}, function (e) {
			if (e === undefined || e.length === 0 || e === null) {
				cmbdata += '<option value="0"> Zonal not available! </option>';
			} else {
				$.each(e, function (index, qdt) {
					if (selected !== undefined || selected !== null || parseInt(selected) > 0) {
						if (parseInt(selected) === parseInt(qdt.zol_id)) {
							cmbdata += '<option value="' + qdt.zol_id + '" selected>' + qdt.zol_name + '</option>';
						} else {
							cmbdata += '<option value="' + qdt.zol_id + '">' + qdt.zol_name + '</option>';
						}
					} else {
						cmbdata += '<option value="' + qdt.zol_id + '">' + qdt.prov_name + '</option>';
					}
				});
			}
			$('.cmbZonal').html('').append(cmbdata);
			chosenRefresh();

			if (callback !== undefined) {
				if (typeof callback === 'function') {
					callback();
				}
			}
		}, "json");
	}

	function cmbDivision(div_zone, selected, callback) {
		var cmbdata = "";
		var dataAvailable = 0;
		$.post('controllers/divisionController.php', {action: 'cmbDivision', div_zone: div_zone}, function (e) {
			if (e === undefined || e.length === 0 || e === null) {
				cmbdata += '<option value="0"> Divisions not available! </option>';
			} else {
				dataAvailable = 1;
				$.each(e, function (index, qdt) {
					if (selected !== undefined || selected !== null || parseInt(selected) > 0) {
						if (parseInt(selected) === parseInt(qdt.div_id)) {
							cmbdata += '<option value="' + qdt.div_id + '" selected>' + qdt.div_name + '</option>';
						} else {
							cmbdata += '<option value="' + qdt.div_id + '">' + qdt.div_name + '</option>';
						}
					} else {
						cmbdata += '<option value="' + qdt.div_id + '">' + qdt.div_name + '</option>';
					}
				});
			}
			$('.cmbDivision').html('').append(cmbdata);
			chosenRefresh();

			if (callback !== undefined) {
				if (typeof callback === 'function') {
					callback(dataAvailable);
				}
			}
		}, "json");
	}

	//new req school options
	function cmbSchoolType(selected, callback) {
		var cmbdata = "";
		var dataAvailable = 0;
		$.post('controllers/instituteController.php', {action: 'cmbSchoolType'}, function (e) {
			if (e === undefined || e.length === 0 || e === null) {
				cmbdata += '<option value="0"> School Type not available! </option>';
			} else {
				dataAvailable = 1;
				$.each(e, function (index, qdt) {
					if (selected !== undefined || selected !== null || parseInt(selected) > 0) {
						if (parseInt(selected) === parseInt(qdt.schtype_id)) {
							cmbdata += '<option value="' + qdt.schtype_id + '" selected>' + qdt.schtype_name + '</option>';
						} else {
							cmbdata += '<option value="' + qdt.schtype_id + '">' + qdt.schtype_name + '</option>';
						}
					} else {
						cmbdata += '<option value="' + qdt.schtype_id + '">' + qdt.schtype_name + '</option>';
					}
				});
			}
			$('.cmbSchoolType').html('').append(cmbdata);
			chosenRefresh();

			if (callback !== undefined) {
				if (typeof callback === 'function') {
					callback(dataAvailable);
				}
			}
		}, "json");
	}

	function cmbSchoolOwnership(selected, callback) {
		var cmbdata = "";
		var dataAvailable = 0;
		$.post('controllers/instituteController.php', {action: 'cmbSchoolOwnership'}, function (e) {
			if (e === undefined || e.length === 0 || e === null) {
				cmbdata += '<option value="0"> School Ownership not available! </option>';
			} else {
				dataAvailable = 1;
				$.each(e, function (index, qdt) {
					if (selected !== undefined || selected !== null || parseInt(selected) > 0) {
						if (parseInt(selected) === parseInt(qdt.schowsh_id)) {
							cmbdata += '<option value="' + qdt.schowsh_id + '" selected>' + qdt.schowsh_name + '</option>';
						} else {
							cmbdata += '<option value="' + qdt.schowsh_id + '">' + qdt.schowsh_name + '</option>';
						}
					} else {
						cmbdata += '<option value="' + qdt.schowsh_id + '">' + qdt.schowsh_name + '</option>';
					}
				});
			}
			$('.cmbSchoolOwnership').html('').append(cmbdata);
			chosenRefresh();

			if (callback !== undefined) {
				if (typeof callback === 'function') {
					callback(dataAvailable);
				}
			}
		}, "json");
	}

	function cmbSchoolMedium(selected, callback) {
		var cmbdata = "";
		var dataAvailable = 0;
		$.post('controllers/instituteController.php', {action: 'cmbSchoolMedium'}, function (e) {
			if (e === undefined || e.length === 0 || e === null) {
				cmbdata += '<option value="0"> School Medium not available! </option>';
			} else {
				dataAvailable = 1;
				$.each(e, function (index, qdt) {
					if (selected !== undefined || selected !== null || parseInt(selected) > 0) {
						if (parseInt(selected) === parseInt(qdt.schmd_id)) {
							cmbdata += '<option value="' + qdt.schmd_id + '" selected>' + qdt.schmd_name + '</option>';
						} else {
							cmbdata += '<option value="' + qdt.schmd_id + '">' + qdt.schmd_name + '</option>';
						}
					} else {
						cmbdata += '<option value="' + qdt.schmd_id + '">' + qdt.schmd_name + '</option>';
					}
				});
			}
			$('.cmbSchoolMedium').html('').append(cmbdata);
			chosenRefresh();

			if (callback !== undefined) {
				if (typeof callback === 'function') {
					callback(dataAvailable);
				}
			}
		}, "json");
	}

	function cmbSchoolClassification(selected, callback) {
		var cmbdata = "";
		var dataAvailable = 0;
		$.post('controllers/instituteController.php', {action: 'cmbSchoolClassification'}, function (e) {
			if (e === undefined || e.length === 0 || e === null) {
				cmbdata += '<option value="0"> School Classification not available! </option>';
			} else {
				dataAvailable = 1;
				$.each(e, function (index, qdt) {
					if (selected !== undefined || selected !== null || parseInt(selected) > 0) {
						if (parseInt(selected) === parseInt(qdt.schcl_id)) {
							cmbdata += '<option value="' + qdt.schcl_id + '" selected>' + qdt.schcl_name + '</option>';
						} else {
							cmbdata += '<option value="' + qdt.schcl_id + '">' + qdt.schcl_name + '</option>';
						}
					} else {
						cmbdata += '<option value="' + qdt.schcl_id + '">' + qdt.schcl_name + '</option>';
					}
				});
			}
			$('.cmbSchoolClassification').html('').append(cmbdata);
			chosenRefresh();

			if (callback !== undefined) {
				if (typeof callback === 'function') {
					callback(dataAvailable);
				}
			}
		}, "json");
	}

	function cmbSchoolGrade(selected, callback) {
		var cmbdata = "";
		var dataAvailable = 0;
		$.post('controllers/instituteController.php', {action: 'cmbSchoolGrade'}, function (e) {
			if (e === undefined || e.length === 0 || e === null) {
				cmbdata += '<option value="0"> School Classification not available! </option>';
			} else {
				dataAvailable = 1;
				$.each(e, function (index, qdt) {
					if (selected !== undefined || selected !== null || parseInt(selected) > 0) {
						if (parseInt(selected) === parseInt(qdt.schgrd_id)) {
							cmbdata += '<option value="' + qdt.schgrd_id + '" selected>' + qdt.schgrd_name + '</option>';
						} else {
							cmbdata += '<option value="' + qdt.schgrd_id + '">' + qdt.schgrd_name + '</option>';
						}
					} else {
						cmbdata += '<option value="' + qdt.schgrd_id + '">' + qdt.schgrd_name + '</option>';
					}
				});
			}
			$('.cmbSchoolGrade').html('').append(cmbdata);
			chosenRefresh();

			if (callback !== undefined) {
				if (typeof callback === 'function') {
					callback(dataAvailable);
				}
			}
		}, "json");
	}
	//end of school options


	function cmbInstituteType(selected, callback) {
		var cmbdata = "";
		var dataAvailable = 0;
		$.post('controllers/instituteController.php', {action: 'cmbInstituteType'}, function (e) {
			if (e === undefined || e.length === 0 || e === null) {
				cmbdata += '<option value="0"> Institute types not available! </option>';
			} else {
				dataAvailable = 1;
				$.each(e, function (index, qdt) {
					if (selected !== undefined || selected !== null || parseInt(selected) > 0) {
						if (parseInt(selected) === parseInt(qdt.insttype_id)) {
							cmbdata += '<option value="' + qdt.insttype_id + '-' + qdt.insttype_nature + '" selected>' + qdt.insttype_name + '</option>';
						} else {
							cmbdata += '<option value="' + qdt.insttype_id + '-' + qdt.insttype_nature + '">' + qdt.insttype_name + '</option>';
						}
					} else {
						cmbdata += '<option value="' + qdt.insttype_id + '-' + qdt.insttype_nature + '">' + qdt.insttype_name + '</option>';
					}
				});
			}
			$('.cmbInstituteType').html('').append(cmbdata);
			chosenRefresh();

			if (callback !== undefined) {
				if (typeof callback === 'function') {
					callback(dataAvailable);
				}
			}
		}, "json");
	}

	function cmbItemMainCategory(selected, callback) {
		var cmbdata = "";
		$.post('controllers/itemMainCategoryController.php', {action: 'cmbItemMainCategory'}, function (e) {
			if (e === undefined || e.length === 0 || e === null) {
				cmbdata += '<option value="0"> Institute types not available! </option>';
			} else {
				$.each(e, function (index, qdt) {
					if (selected !== undefined || selected !== null || parseInt(selected) > 0) {
						if (parseInt(selected) === parseInt(qdt.mcat_id)) {
							cmbdata += '<option value="' + qdt.mcat_id + '" selected>' + qdt.mcat_code + ' | ' + qdt.mcat_name + '</option>';
						} else {
							cmbdata += '<option value="' + qdt.mcat_id + '">' + qdt.mcat_code + ' | ' + qdt.mcat_name + '</option>';
						}
					} else {
						cmbdata += '<option value="' + qdt.mcat_id + '">' + qdt.mcat_code + ' | ' + qdt.mcat_name + '</option>';
					}
				});
			}
			$('.cmbItemMainCategory').html('').append(cmbdata);
			chosenRefresh();

			if (callback !== undefined) {
				if (typeof callback === 'function') {
					callback();
				}
			}
		}, "json");
	}


	function cmbItemSub1Category(scat_maincategory, selected, callback) {
		var cmbdata = "";
		$.post('controllers/itemSub1CategoryController.php', {action: 'cmbItemSub1Category', scat_maincategory: scat_maincategory}, function (e) {
			if (e === undefined || e.length === 0 || e === null) {
				cmbdata += '<option value="0"> Institute types not available! </option>';
			} else {
				$.each(e, function (index, qdt) {
					if (selected !== undefined || selected !== null || parseInt(selected) > 0) {
						if (parseInt(selected) === parseInt(qdt.scat_id)) {
							cmbdata += '<option value="' + qdt.scat_id + '" selected>' + qdt.scat_code + ' | ' + qdt.scat_name + '</option>';
						} else {
							cmbdata += '<option value="' + qdt.scat_id + '">' + qdt.scat_code + ' | ' + qdt.scat_name + '</option>';
						}
					} else {
						cmbdata += '<option value="' + qdt.scat_id + '">' + qdt.scat_code + ' | ' + qdt.scat_name + '</option>';
					}
				});
			}
			$('.cmbItemSub1Category').html('').append(cmbdata);
			chosenRefresh();

			if (callback !== undefined) {
				if (typeof callback === 'function') {
					callback();
				}
			}
		}, "json");
	}

	function cmbItemSub2Category(s2cat_subcategory, selected, callback) {
		var cmbdata = "";
		var dataAvailable = 0;
		$.post('controllers/itemSub2CategoryController.php', {action: 'cmbItemSub2Category', s2cat_subcategory: s2cat_subcategory}, function (e) {
			if (e === undefined || e.length === 0 || e === null) {
				cmbdata += '<option value="0"> Institute types not available! </option>';
			} else {
				dataAvailable = 1;
				$.each(e, function (index, qdt) {
					if (selected !== undefined || selected !== null || parseInt(selected) > 0) {
						if (parseInt(selected) === parseInt(qdt.s2cat_id)) {
							cmbdata += '<option value="' + qdt.s2cat_id + '" selected>' + qdt.s2cat_code + ' | ' + qdt.s2cat_name + '</option>';
						} else {
							cmbdata += '<option value="' + qdt.s2cat_id + '">' + qdt.s2cat_code + ' | ' + qdt.s2cat_name + '</option>';
						}
					} else {
						cmbdata += '<option value="' + qdt.s2cat_id + '">' + qdt.s2cat_code + ' | ' + qdt.s2cat_name + '</option>';
					}
				});
			}
			$('.cmbItemSub2Category').html('').append(cmbdata);
			chosenRefresh();

			if (callback !== undefined) {
				if (typeof callback === 'function') {
					callback(dataAvailable);
				}
			}
		}, "json");
	}


	function cmbInstitute(inst_division, inst_institutetype, selected, callback) {
		var cmbdata = "";
		var dataAvailable = 0;
		$.post('controllers/instituteController.php', {action: 'cmbInstitute', inst_division: inst_division, inst_institutetype: inst_institutetype}, function (e) {
			if (e === undefined || e.length === 0 || e === null) {
				cmbdata += '<option value="0"> Institutes not available! </option>';
			} else {
				dataAvailable = 1;
				$.each(e, function (index, qdt) {
					if (selected !== undefined || selected !== null || parseInt(selected) > 0) {
						if (parseInt(selected) === parseInt(qdt.inst_id)) {
							cmbdata += '<option value="' + qdt.inst_id + '" selected>' + qdt.inst_name + '</option>';
						} else {
							cmbdata += '<option value="' + qdt.inst_id + '">' + qdt.inst_name + '</option>';
						}
					} else {
						cmbdata += '<option value="' + qdt.inst_id + '">' + qdt.inst_name + '</option>';
					}
				});
			}
			$('.cmbInstitute').html('').append(cmbdata);
			chosenRefresh();

			if (callback !== undefined) {
				if (typeof callback === 'function') {
					callback(dataAvailable);
				}
			}
		}, "json");
	}

	function cmbIssue(selected, callback) {
		var cmbdata = "";
		var dataAvailable = 0;
		$.post('controllers/issueController.php', {action: 'cmbIssue'}, function (e) {
			if (e === undefined || e.length === 0 || e === null) {
				cmbdata += '<option value="0"> Issuing not available! </option>';
			} else {
				dataAvailable = 1;
				$.each(e, function (index, qdt) {
					if (selected !== undefined || selected !== null || parseInt(selected) > 0) {
						if (parseInt(selected) === parseInt(qdt.issu_id)) {
							cmbdata += '<option value="' + qdt.issu_id + '" selected>(' + qdt.issu_custom_issueno + ') - ' + qdt.inst_name + '</option>';
						} else {
							cmbdata += '<option value="' + qdt.issu_id + '">(' + qdt.issu_custom_issueno + ') - ' + qdt.inst_name + '</option>';
						}
					} else {
						cmbdata += '<option value="' + qdt.issu_id + '">(' + qdt.issu_custom_issueno + ') - ' + qdt.inst_name + '</option>';
					}
				});
			}
			$('.cmbIssue').html('').append(cmbdata);
			chosenRefresh();

			if (callback !== undefined) {
				if (typeof callback === 'function') {
					callback(dataAvailable);
				}
			}
		}, "json");
	}

	function cmbInstituteExceptLoggedOne(inst_division, inst_institutetype, selected, callback) {
		var cmbdata = "";
		var dataAvailable = 0;
		$.post('controllers/instituteController.php', {action: 'cmbInstituteExceptLoggedOne', inst_division: inst_division, inst_institutetype: inst_institutetype}, function (e) {
			if (e === undefined || e.length === 0 || e === null) {
				cmbdata += '<option value="0"> Institutes not available! </option>';
			} else {
				dataAvailable = 1;
				$.each(e, function (index, qdt) {
					if (selected !== undefined || selected !== null || parseInt(selected) > 0) {
						if (parseInt(selected) === parseInt(qdt.inst_id)) {
							cmbdata += '<option value="' + qdt.inst_id + '" selected>' + qdt.inst_name + '</option>';
						} else {
							cmbdata += '<option value="' + qdt.inst_id + '">' + qdt.inst_name + '</option>';
						}
					} else {
						cmbdata += '<option value="' + qdt.inst_id + '">' + qdt.inst_name + '</option>';
					}
				});
			}
			$('.cmbInstitute').html('').append(cmbdata);
			chosenRefresh();

			if (callback !== undefined) {
				if (typeof callback === 'function') {
					callback(dataAvailable);
				}
			}
		}, "json");
	}


	function cmbItem(itm_sub2category, selected, callback) {
		var cmbdata = "";
		var dataAvailable = 0;
		$.post('controllers/itemController.php', {action: 'cmbItem', itm_sub2category: itm_sub2category}, function (e) {
			if (e === undefined || e.length === 0 || e === null) {
				cmbdata += '<option value="0"> Institute types not available! </option>';
			} else {
				dataAvailable = 1;
				$.each(e, function (index, qdt) {
					if (selected !== undefined || selected !== null || parseInt(selected) > 0) {
						if (parseInt(selected) === parseInt(qdt.itm_id)) {
							cmbdata += '<option value="' + qdt.itm_id + '" selected>' + qdt.itm_code + ' | ' + qdt.itm_name + '</option>';
						} else {
							cmbdata += '<option value="' + qdt.itm_id + '">' + qdt.itm_code + ' | ' + qdt.itm_name + '</option>';
						}
					} else {
						cmbdata += '<option value="' + qdt.itm_id + '">' + qdt.itm_code + ' | ' + qdt.itm_name + '</option>';
					}
				});
			}
			$('.cmbItem').html('').append(cmbdata);
			chosenRefresh();

			if (callback !== undefined) {
				if (typeof callback === 'function') {
					callback(dataAvailable);
				}
			}
		}, "json");
	}

	function cmbAttributeType(attype_item, selected, callback) {
		var cmbdata = "";
		var dataAvailable = 0;
		$.post('controllers/attributeTypeController.php', {action: 'cmbAttributeType', attype_item: attype_item}, function (e) {
			if (e === undefined || e.length === 0 || e === null) {
				cmbdata += '<option value="0"> Arribute types not available! </option>';
			} else {
				dataAvailable = 1;
				$.each(e, function (index, qdt) {
					if (selected !== undefined || selected !== null || parseInt(selected) > 0) {
						if (parseInt(selected) === parseInt(qdt.attype_id)) {
							cmbdata += '<option value="' + qdt.attype_id + '" selected>' + qdt.attype_name + '</option>';
						} else {
							cmbdata += '<option value="' + qdt.attype_id + '">' + qdt.attype_name + '</option>';
						}
					} else {
						cmbdata += '<option value="' + qdt.attype_id + '">' + qdt.attype_name + '</option>';
					}
				});
			}
			$('.cmbAttributeType').html('').append(cmbdata);
			chosenRefresh();

			if (callback !== undefined) {
				if (typeof callback === 'function') {
					callback(dataAvailable);
				}
			}
		}, "json");
	}

	function cmbAttribute(at_attributetype, selected, callback) {
		var cmbdata = "";
		var dataAvailable = 0;
		$.post('controllers/attributeController.php', {action: 'cmbAttribute', at_attributetype: at_attributetype}, function (e) {
			if (e === undefined || e.length === 0 || e === null) {
				cmbdata += '<option value="0"> Arribute types not available! </option>';
			} else {
				dataAvailable = 1;
				$.each(e, function (index, qdt) {
					if (selected !== undefined || selected !== null || parseInt(selected) > 0) {
						if (parseInt(selected) === parseInt(qdt.at_id)) {
//							cmbdata += '<option value="' + qdt.at_id + '" selected>' + qdt.at_name + ' - Rs.' + qdt.at_price + ' (Valuation)</option>';
							cmbdata += '<option value="' + qdt.at_id + '" selected>' + qdt.at_name + '</option>';
						} else {
							cmbdata += '<option value="' + qdt.at_id + '">' + qdt.at_name + '</option>';
						}
					} else {
						cmbdata += '<option value="' + qdt.at_id + '">' + qdt.at_name + '</option>';
					}
				});
			}
			$('.cmbAttribute').html('').append(cmbdata);
			chosenRefresh();

			if (callback !== undefined) {
				if (typeof callback === 'function') {
					callback(dataAvailable);
				}
			}
		}, "json");
	}


	function cmbSupplier(selected, callback) {
		var cmbdata = "";
		var dataAvailable = 0;
		$.post('controllers/supplierController.php', {action: 'cmbSupplier'}, function (e) {
			if (e === undefined || e.length === 0 || e === null) {
				cmbdata += '<option value="0"> Supplier not available! </option>';
			} else {
				dataAvailable = 1;
				$.each(e, function (index, qdt) {
					if (selected !== undefined || selected !== null || parseInt(selected) > 0) {
						if (parseInt(selected) === parseInt(qdt.sup_id)) {
							cmbdata += '<option value="' + qdt.sup_id + '" selected>' + qdt.sup_name + '</option>';
						} else {
							cmbdata += '<option value="' + qdt.sup_id + '">' + qdt.sup_name + '</option>';
						}
					} else {
						cmbdata += '<option value="' + qdt.sup_id + '">' + qdt.sup_name + '</option>';
					}
				});
			}
			$('.cmbSupplier').html('').append(cmbdata);
			chosenRefresh();

			if (callback !== undefined) {
				if (typeof callback === 'function') {
					callback(dataAvailable);
				}
			}
		}, "json");
	}

	function cmbUserCategory(usrcat_institute, selected, callback) {
		var cmbdata = "";
		var dataAvailable = 0;
		$.post('controllers/userCategoryController.php', {action: 'cmbUserCategory', usrcat_institute: usrcat_institute}, function (e) {
			if (e === undefined || e.length === 0 || e === null) {
				cmbdata += '<option value="0"> User category not available! </option>';
			} else {
				dataAvailable = 1;
				$.each(e, function (index, qdt) {
					if (selected !== undefined || selected !== null || parseInt(selected) > 0) {
						if (parseInt(selected) === parseInt(qdt.usrcat_id)) {
							cmbdata += '<option value="' + qdt.usrcat_id + '" selected>' + qdt.usrcat_name + '</option>';
						} else {
							cmbdata += '<option value="' + qdt.usrcat_id + '">' + qdt.usrcat_name + '</option>';
						}
					} else {
						cmbdata += '<option value="' + qdt.usrcat_id + '">' + qdt.usrcat_name + '</option>';
					}
				});
			}
			$('.cmbUserCategory').html('').append(cmbdata);
			chosenRefresh();

			if (callback !== undefined) {
				if (typeof callback === 'function') {
					callback(dataAvailable);
				}
			}
		}, "json");
	}


</script>

